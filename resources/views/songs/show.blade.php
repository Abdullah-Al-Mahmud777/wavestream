@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card bg-dark text-white border-0 shadow-lg">
                <div class="card-body p-4">
                    <div class="text-center mb-4">
                        <img src="{{ $song->cover_image ? asset('storage/' . $song->cover_image) : asset('images/default-album.png') }}"
                             class="img-fluid rounded" style="max-height: 300px;" alt="{{ $song->title }}">
                    </div>

                    <h2 class="text-center mb-3">{{ $song->title }}</h2>
                    <p class="text-center text-muted mb-4">{{ $song->artist }}</p>

                    <div class="audio-player mb-4">
                        <audio controls class="w-100" preload="metadata">
                            <source src="{{ asset('storage/' . $song->file_path) }}" type="audio/mpeg">
                            Your browser does not support the audio element.
                        </audio>
                        @error('error')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="mb-1">
                                <strong>Category:</strong>
                                <span class="text-muted">
                                    @if($song->category)
                                        {{ $song->category->name }}
                                    @else
                                        No category available
                                    @endif
                                </span>
                            </p>
                            <p class="mb-0">
                                <strong>Uploaded:</strong>
                                <span class="text-muted">{{ $song->created_at->format('F j, Y') }}</span>
                            </p>
                        </div>

                        @auth
                            <div class="dropdown">
                                <button class="btn btn-outline-primary" type="button" data-bs-toggle="dropdown">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end bg-dark">
                                    <li>
                                        <a class="dropdown-item text-white" href="#" data-bs-toggle="modal" data-bs-target="#addToPlaylistModal">
                                            <i class="fas fa-plus me-2"></i>Add to Playlist
                                        </a>
                                    </li>
                                    @if(auth()->user()->isAdmin())
                                        <li>
                                            <a class="dropdown-item text-white" href="{{ route('songs.edit', $song) }}">
                                                <i class="fas fa-edit me-2"></i>Edit
                                            </a>
                                        </li>
                                        <li>
                                            <form action="{{ route('songs.destroy', $song) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item text-white" onclick="return confirm('Are you sure?')">
                                                    <i class="fas fa-trash me-2"></i>Delete
                                                </button>
                                            </form>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@auth
    <!-- Add to Playlist Modal -->
    <div class="modal fade" id="addToPlaylistModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content bg-dark">
                <div class="modal-header border-0">
                    <h5 class="modal-title">Add to Playlist</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    @if(auth()->user()->playlists->count() > 0)
                        <form action="" method="POST" id="addToPlaylistFormShow">
                            @csrf
                            <div class="mb-3">
                                <select name="playlist_id" class="form-select bg-dark text-white" onchange="document.getElementById('addToPlaylistFormShow').action = '/playlists/' + this.value + '/songs';">
                                    <option value="">Select Playlist</option>
                                    @foreach(auth()->user()->playlists as $playlist)
                                        <option value="{{ $playlist->id }}">{{ $playlist->name }}</option>
                                    @endforeach
                                </select>
                                <input type="hidden" name="song_id" value="{{ $song->id }}">
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Add to Playlist</button>
                        </form>
                    @else
                        <p class="text-center mb-0">You don't have any playlists yet.</p>
                        <div class="text-center mt-3">
                            <a href="{{ route('playlists.create') }}" class="btn btn-primary">Create Playlist</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endauth

<style>
    .audio-player audio {
        background-color: #1a1a1a;
        border-radius: 8px;
    }

    .audio-player audio::-webkit-media-controls-panel {
        background-color: #1a1a1a;
    }

    .audio-player audio::-webkit-media-controls-current-time-display,
    .audio-player audio::-webkit-media-controls-time-remaining-display {
        color: #fff;
    }

    .dropdown-menu {
        border: 1px solid #333;
    }

    .dropdown-item:hover {
        background-color: #1DB954;
    }
</style>
@endsection