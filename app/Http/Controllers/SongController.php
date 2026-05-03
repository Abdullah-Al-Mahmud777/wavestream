<?php

namespace App\Http\Controllers;

use App\Models\Song;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SongController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $query = Song::with('category');

        // Search filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('artist', 'like', "%{$search}%");
            });
        }

        // Category filter
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Sort
        switch ($request->get('sort', 'latest')) {
            case 'oldest':
                $query->oldest();
                break;
            case 'name':
                $query->orderBy('title');
                break;
            default:
                $query->latest();
        }

        $songs = $query->get();
        $categories = Category::all();
        
        return view('songs.index', compact('songs', 'categories'));
    }

    public function show(Song $song)
    {

        return view('songs.show', compact('song'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('songs.create', compact('categories'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'artist' => 'required|string|max:255',
                'audio_file' => 'required|file|mimes:mp3,m4a,wav|max:20000',
                'cover_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            // Store audio file
            $audioPath = $request->file('audio_file')->store('songs', 'public');
            if (!$audioPath) {
                throw new \Exception('Failed to store audio file');
            }

            // Calculate duration
            $getID3 = new \getID3;
            $file = $getID3->analyze(storage_path('app/public/' . $audioPath));
            $duration = isset($file['playtime_seconds']) ? round($file['playtime_seconds']) : null;

            // Store cover image if provided
            $coverPath = null;
            if ($request->hasFile('cover_image')) {
                $coverPath = $request->file('cover_image')->store('covers', 'public');
                if (!$coverPath) {
                    throw new \Exception('Failed to store cover image');
                }
            }

            $song = Song::create([
                'title' => $request->title,
                'artist' => $request->artist,
                'file_path' => $audioPath,
                'cover_image' => $coverPath,
                'duration' => $duration,
                'user_id' => Auth::id(),
            ]);

            return redirect()->route('songs.show', $song)
                ->with('success', 'Song uploaded successfully.');
        } catch (\Exception $e) {
            // Delete uploaded files if song creation fails
            if (isset($audioPath)) {
                Storage::disk('public')->delete($audioPath);
            }
            if (isset($coverPath)) {
                Storage::disk('public')->delete($coverPath);
            }

            return back()->withInput()
                ->withErrors(['error' => 'Failed to upload song: ' . $e->getMessage()]);
        }
    }

    public function edit(Song $song)
    {
        $categories = Category::where('is_active', true)->get();
        return view('songs.edit', compact('song', 'categories'));
    }

    public function update(Request $request, Song $song)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'artist' => 'required|string|max:255',
            'album' => 'nullable|string|max:255',
            'audio_file' => 'nullable|file|mimes:mp3,wav|max:10240',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        if ($request->hasFile('audio_file')) {
            Storage::disk('public')->delete($song->file_path);
            $validated['file_path'] = $request->file('audio_file')->store('songs', 'public');
        }

        if ($request->hasFile('cover_image')) {
            if ($song->cover_image) {
                Storage::disk('public')->delete($song->cover_image);
            }
            $validated['cover_image'] = $request->file('cover_image')->store('covers', 'public');
        }

        $song->update($validated);

        return redirect()->route('songs.show', $song)
            ->with('success', 'Song updated successfully.');
    }

    public function destroy(Song $song)
    {
        Storage::disk('public')->delete($song->file_path);
        if ($song->cover_image) {
            Storage::disk('public')->delete($song->cover_image);
        }

        $song->delete();

        return redirect()->route('songs.index')
            ->with('success', 'Song deleted successfully.');
    }
}