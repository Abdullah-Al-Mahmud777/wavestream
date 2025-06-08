@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>My Playlists</h1>
        <a href="{{ route('playlists.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Create Playlist
        </a>
    </div>

    <!-- Playlists Grid -->
    <div class="row g-4">
        @forelse($playlists as $playlist)
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <h5 class="card-title">{{ $playlist->name }}</h5>
                            <div class="dropdown">
                                <button class="btn btn-link text-white" type="button" data-bs-toggle="dropdown">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end bg-dark">
                                    <li>
                                        <a class="dropdown-item text-white" href="{{ route('playlists.edit', $playlist) }}">
                                            <i class="fas fa-edit me-2"></i>Edit
                                        </a>
                                    </li>
                                    <li>
                                        <form action="{{ route('playlists.destroy', $playlist) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item text-white" onclick="return confirm('Are you sure?')">
                                                <i class="fas fa-trash me-2"></i>Delete
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        
                        <p class="card-text text-muted mb-3">
                            {{ $playlist->songs->count() }} songs
                        </p>

                        @if($playlist->songs->count() > 0)
                            <div class="songs-preview">
                                @foreach($playlist->songs->take(3) as $song)
                                    <div class="d-flex align-items-center mb-2">
                                        <img src="{{ $song->cover_image ? asset('storage/' . $song->cover_image) : asset('images/default-album.png') }}" 
                                             class="rounded me-2" style="width: 40px; height: 40px; object-fit: cover;" 
                                             alt="{{ $song->title }}">
                                        <div class="flex-grow-1">
                                            <div class="text-truncate">{{ $song->title }}</div>
                                            <small class="text-muted">{{ $song->artist }}</small>
                                        </div>
                                    </div>
                                @endforeach
                                @if($playlist->songs->count() > 3)
                                    <div class="text-center">
                                        <small class="text-muted">+{{ $playlist->songs->count() - 3 }} more songs</small>
                                    </div>
                                @endif
                            </div>
                        @else
                            <div class="text-center py-3">
                                <p class="text-muted mb-0">No songs in this playlist yet</p>
                                <a href="{{ route('songs.index') }}" class="btn btn-sm btn-primary mt-2">
                                    <i class="fas fa-plus me-1"></i>Add Songs
                                </a>
                            </div>
                        @endif
                    </div>
                    <div class="card-footer bg-transparent border-top-0">
                        <a href="{{ route('playlists.show', $playlist) }}" class="btn btn-primary w-100">
                            <i class="fas fa-play me-1"></i>Play Playlist
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">
                    You don't have any playlists yet. <a href="{{ route('playlists.create') }}">Create one now!</a>
                </div>
            </div>
        @endforelse
    </div>
</div>

@push('styles')
<style>
    .card {
        transition: transform 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
    }

    .dropdown-menu {
        border: 1px solid #333;
    }

    .dropdown-item:hover {
        background-color: #1DB954;
    }

    .songs-preview {
        max-height: 200px;
        overflow-y: auto;
    }

    .songs-preview::-webkit-scrollbar {
        width: 5px;
    }

    .songs-preview::-webkit-scrollbar-track {
        background: #181818;
    }

    .songs-preview::-webkit-scrollbar-thumb {
        background: #1DB954;
        border-radius: 5px;
    }
</style>
@endpush
@endsection 