<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Music;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MusicController extends Controller
{
    /**
     * Display a listing of the music.
     */
    public function index()
    {
        $musics = Music::latest()->paginate(10);
        return view('admin.music.index', compact('musics'));
    }

    /**
     * Show the form for creating a new music.
     */
    public function create()
    {
        return view('admin.music.create');
    }

    /**
     * Store a newly created music in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'artist' => 'required|string|max:255',
            'album' => 'nullable|string|max:255',
            'genre' => 'required|string|max:255',
            'file' => 'required|file|mimes:mp3,wav|max:10240',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $music = new Music();
        $music->title = $request->title;
        $music->artist = $request->artist;
        $music->album = $request->album;
        $music->genre = $request->genre;

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/music', $filename);
            $music->file_path = 'music/' . $filename;
        }

        if ($request->hasFile('cover_image')) {
            $image = $request->file('cover_image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('public/cover_images', $imageName);
            $music->cover_image = 'cover_images/' . $imageName;
        }

        $music->save();

        return redirect()->route('admin.music.index')
            ->with('success', 'Music added successfully.');
    }

    /**
     * Display the specified music.
     */
    public function show(Music $music)
    {
        return view('admin.music.show', compact('music'));
    }

    /**
     * Show the form for editing the specified music.
     */
    public function edit(Music $music)
    {
        return view('admin.music.edit', compact('music'));
    }

    /**
     * Update the specified music in storage.
     */
    public function update(Request $request, Music $music)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'artist' => 'required|string|max:255',
            'album' => 'nullable|string|max:255',
            'genre' => 'required|string|max:255',
            'file' => 'nullable|file|mimes:mp3,wav|max:10240',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $music->title = $request->title;
        $music->artist = $request->artist;
        $music->album = $request->album;
        $music->genre = $request->genre;

        if ($request->hasFile('file')) {
            // Delete old file
            if ($music->file_path) {
                Storage::delete('public/' . $music->file_path);
            }
            
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/music', $filename);
            $music->file_path = 'music/' . $filename;
        }

        if ($request->hasFile('cover_image')) {
            // Delete old image
            if ($music->cover_image) {
                Storage::delete('public/' . $music->cover_image);
            }
            
            $image = $request->file('cover_image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('public/cover_images', $imageName);
            $music->cover_image = 'cover_images/' . $imageName;
        }

        $music->save();

        return redirect()->route('admin.music.index')
            ->with('success', 'Music updated successfully.');
    }

    /**
     * Remove the specified music from storage.
     */
    public function destroy(Music $music)
    {
        // Delete associated files
        if ($music->file_path) {
            Storage::delete('public/' . $music->file_path);
        }
        if ($music->cover_image) {
            Storage::delete('public/' . $music->cover_image);
        }

        $music->delete();

        return redirect()->route('admin.music.index')
            ->with('success', 'Music deleted successfully.');
    }
} 