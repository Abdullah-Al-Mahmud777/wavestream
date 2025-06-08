@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Music Library</h1>
        @auth
            <a href="{{ route('songs.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>Upload Song
            </a>
        @endauth
    </div>

    <!-- Search and Filter Section -->
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('songs.index') }}" method="GET" class="row g-3">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control bg-dark text-white" placeholder="Search songs..." value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                    <select name="category" class="form-select bg-dark text-white">
                        <option value="">All Categories</option>
                        @foreach($categories ?? [] as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="sort" class="form-select bg-dark text-white">
                        <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Latest</option>
                        <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest</option>
                        <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Name</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">Filter</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Songs Grid -->
    <div class="row g-4">
        @forelse($songs as $song)
            <div class="col-md-3">
                <div class="card h-100">
                    <img src="{{ $song->cover_image ? asset('storage/' . $song->cover_image) : asset('images/default-album.png') }}"
                         class="card-img-top" alt="{{ $song->title }}">
                    <div class="card-body">
                        <h5 class="card-title text-truncate">{{ $song->title }}</h5>
                        <p class="card-text mb-1">{{ $song->artist }}</p>
                        <p class="card-text text-muted small">{{ $song->category?->name }}</p>
                    </div>
                    <div class="card-footer bg-transparent border-top-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('songs.show', $song) }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-play me-1"></i>Play
                            </a>
                            @auth
                                <div class="dropdown">
                                    <button class="btn btn-link text-white" type="button" data-bs-toggle="dropdown">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end bg-dark">
                                        <li>
                                            <a class="dropdown-item text-white" href="#" data-bs-toggle="modal" data-bs-target="#addToPlaylistModal{{ $song->id }}">
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

                <!-- Add to Playlist Modal -->
                @auth
                    <div class="modal fade" id="addToPlaylistModal{{ $song->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content bg-dark">
                                <div class="modal-header border-0">
                                    <h5 class="modal-title">Add to Playlist</h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    @if(auth()->user()->playlists->count() > 0)
                                        <form action="" method="POST" id="addToPlaylistForm{{ $song->id }}">
                                            @csrf
                                            <div class="mb-3">
                                                <select name="playlist_id" class="form-select bg-dark text-white" onchange="document.getElementById('addToPlaylistForm{{ $song->id }}').action = '/playlists/' + this.value + '/songs';">
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
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">
                    No songs found. @auth <a href="{{ route('songs.create') }}">Upload one now!</a> @endauth
                </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $songs->links() }}
    </div>
</div>

@push('styles')
<style>
    .card-img-top {
        height: 200px;
        object-fit: cover;
    }

    .dropdown-menu {
        border: 1px solid #333;
    }

    .dropdown-item:hover {
        background-color: #1DB954;
    }

    .pagination {
        justify-content: center;
    }

    .page-link {
        background-color: #181818;
        border-color: #333;
        color: #fff;
    }

    .page-link:hover {
        background-color: #1DB954;
        border-color: #1DB954;
        color: #fff;
    }

    .page-item.active .page-link {
        background-color: #1DB954;
        border-color: #1DB954;
    }
</style>
@endpush
@endsection