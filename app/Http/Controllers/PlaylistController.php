<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use App\Models\Song;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlaylistController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // Fix variable naming
        $playlists = Auth::user()->playlists()->with('songs')->get();
        return view('playlists.index', compact('playlists'));
    }

    public function create()
    {
        return view('playlists.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        // Fix variable naming
        $playlist = Auth::user()->playlists()->create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('playlists.show', $playlist)
            ->with('success', 'Playlist created successfully.');
    }

    public function show(Playlist $playlist)
    {
        $this->authorize('view', $playlist);
        $playlist->load('songs');
        return view('playlists.show', compact('playlist'));
    }

    public function edit(Playlist $playlist)
    {
        $this->authorize('update', $playlist);
        return view('playlists.edit', compact('playlist'));
    }

    public function update(Request $request, Playlist $playlist)
    {
        $this->authorize('update', $playlist);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $playlist->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('playlists.show', $playlist)
            ->with('success', 'Playlist updated successfully.');
    }

    public function destroy(Playlist $playlist)
    {
        $this->authorize('delete', $playlist);
        $playlist->delete();

        return redirect()->route('playlists.index')
            ->with('success', 'Playlist deleted successfully.');
    }

    public function addSong(Request $request, Playlist $playlist)
    {
        $this->authorize('update', $playlist);

        $request->validate([
            'song_id' => 'required|exists:songs,id',
        ]);

        $playlist->songs()->attach($request->song_id);

        return back()->with('success', 'Song added to playlist successfully.');
    }

    public function removeSong(Request $request, Playlist $playlist)
    {
        $this->authorize('update', $playlist);

        $request->validate([
            'song_id' => 'required|exists:songs,id',
        ]);

        $playlist->songs()->detach($request->song_id);

        return back()->with('success', 'Song removed from playlist successfully.');
    }

    public function reorderSongs(Request $request, Playlist $playlist)
    {
        $this->authorize('update', $playlist);

        $request->validate([
            'songs' => 'required|array',
            'songs.*' => 'exists:songs,id',
        ]);

        foreach ($request->songs as $index => $songId) {
            $playlist->songs()->updateExistingPivot($songId, ['order' => $index]);
        }

        return response()->json(['message' => 'Songs reordered successfully']);
    }
}
