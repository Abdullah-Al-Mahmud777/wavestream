@extends('layouts.app')

@section('content')
<style>
    .page-header {
        background: linear-gradient(135deg, rgba(29, 185, 84, 0.1), rgba(0, 0, 0, 0.3));
        padding: 3rem 0 2rem;
        margin-bottom: 2rem;
        border-radius: 0 0 20px 20px;
    }

    .page-title {
        font-size: 2.5rem;
        font-weight: 700;
        background: linear-gradient(45deg, #1db954, #1ed760);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: 0.5rem;
    }

    .page-subtitle {
        color: #b3b3b3;
        font-size: 1.1rem;
    }

    .filter-card {
        background: rgba(30, 30, 30, 0.8);
        border: 1px solid #282828;
        border-radius: 15px;
        padding: 1.5rem;
        margin-bottom: 2rem;
        backdrop-filter: blur(10px);
    }

    .form-control, .form-select {
        background: rgba(0, 0, 0, 0.4);
        border: 1px solid #282828;
        color: #ffffff;
        padding: 0.75rem 1rem;
        border-radius: 10px;
        transition: all 0.3s ease;
    }

    .form-control:focus, .form-select:focus {
        background: rgba(0, 0, 0, 0.6);
        border-color: #1db954;
        box-shadow: 0 0 0 3px rgba(29, 185, 84, 0.1);
        color: #ffffff;
    }

    .form-control::placeholder {
        color: #666;
    }

    .song-card {
        background: rgba(30, 30, 30, 0.8);
        border: 1px solid #282828;
        border-radius: 15px;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        height: 100%;
        backdrop-filter: blur(10px);
    }

    .song-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 40px rgba(29, 185, 84, 0.2);
        border-color: #1db954;
    }

    .song-card-img {
        position: relative;
        overflow: hidden;
        height: 250px;
    }

    .song-card-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s ease;
    }

    .song-card:hover .song-card-img img {
        transform: scale(1.1);
    }

    .song-card-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(to bottom, transparent 0%, rgba(0, 0, 0, 0.8) 100%);
        opacity: 0;
        transition: opacity 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .song-card:hover .song-card-overlay {
        opacity: 1;
    }

    .play-btn-large {
        width: 60px;
        height: 60px;
        background: #1db954;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        color: white;
        transition: all 0.3s ease;
        box-shadow: 0 5px 20px rgba(29, 185, 84, 0.4);
    }

    .play-btn-large:hover {
        transform: scale(1.1);
        box-shadow: 0 8px 30px rgba(29, 185, 84, 0.6);
    }

    .song-card-body {
        padding: 1.5rem;
    }

    .song-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: #ffffff;
        margin-bottom: 0.5rem;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .song-artist {
        color: #b3b3b3;
        font-size: 0.9rem;
        margin-bottom: 0.3rem;
    }

    .song-category {
        display: inline-block;
        background: rgba(29, 185, 84, 0.1);
        color: #1db954;
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 500;
        border: 1px solid rgba(29, 185, 84, 0.3);
    }

    .song-card-footer {
        padding: 1rem 1.5rem;
        background: rgba(0, 0, 0, 0.3);
        border-top: 1px solid #282828;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .btn-play {
        background: linear-gradient(135deg, #1db954, #1ed760);
        border: none;
        color: white;
        padding: 0.5rem 1.5rem;
        border-radius: 25px;
        font-weight: 600;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(29, 185, 84, 0.3);
    }

    .btn-play:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(29, 185, 84, 0.4);
        color: white;
    }

    .btn-menu {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid #282828;
        color: #b3b3b3;
        width: 35px;
        height: 35px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }

    .btn-menu:hover {
        background: rgba(29, 185, 84, 0.1);
        border-color: #1db954;
        color: #1db954;
    }

    .dropdown-menu {
        background: #1e1e1e;
        border: 1px solid #282828;
        border-radius: 10px;
        padding: 0.5rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
    }

    .dropdown-item {
        color: #ffffff;
        padding: 0.75rem 1rem;
        border-radius: 8px;
        transition: all 0.2s ease;
    }

    .dropdown-item:hover {
        background: rgba(29, 185, 84, 0.1);
        color: #1db954;
    }

    .btn-filter {
        background: linear-gradient(135deg, #1db954, #1ed760);
        border: none;
        color: white;
        padding: 0.75rem 2rem;
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-filter:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(29, 185, 84, 0.4);
    }

    .btn-upload {
        background: linear-gradient(135deg, #1db954, #1ed760);
        border: none;
        color: white;
        padding: 0.75rem 2rem;
        border-radius: 25px;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(29, 185, 84, 0.3);
    }

    .btn-upload:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(29, 185, 84, 0.4);
        color: white;
    }

    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        background: rgba(30, 30, 30, 0.5);
        border-radius: 15px;
        border: 2px dashed #282828;
    }

    .empty-state i {
        font-size: 4rem;
        color: #282828;
        margin-bottom: 1.5rem;
    }

    .empty-state h3 {
        color: #ffffff;
        margin-bottom: 1rem;
    }

    .empty-state p {
        color: #b3b3b3;
        margin-bottom: 2rem;
    }

    .modal-content {
        background: #1e1e1e;
        border: 1px solid #282828;
        border-radius: 15px;
    }

    .modal-header {
        border-bottom: 1px solid #282828;
        padding: 1.5rem;
    }

    .modal-title {
        color: #ffffff;
        font-weight: 600;
    }

    .btn-close {
        filter: invert(1);
    }

    .pagination {
        justify-content: center;
        gap: 0.5rem;
    }

    .page-link {
        background: rgba(30, 30, 30, 0.8);
        border: 1px solid #282828;
        color: #ffffff;
        padding: 0.75rem 1rem;
        border-radius: 10px;
        transition: all 0.3s ease;
    }

    .page-link:hover {
        background: rgba(29, 185, 84, 0.1);
        border-color: #1db954;
        color: #1db954;
    }

    .page-item.active .page-link {
        background: linear-gradient(135deg, #1db954, #1ed760);
        border-color: #1db954;
        color: white;
    }

    @media (max-width: 768px) {
        .page-title {
            font-size: 2rem;
        }

        .song-card-img {
            height: 200px;
        }
    }
</style>

<div class="page-header">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="page-title">
                    <i class="fas fa-music me-2"></i>Music Library
                </h1>
                <p class="page-subtitle">Discover and enjoy thousands of songs</p>
            </div>
            @auth
                <a href="{{ route('songs.create') }}" class="btn btn-upload">
                    <i class="fas fa-cloud-upload-alt me-2"></i>Upload Song
                </a>
            @endauth
        </div>
    </div>
</div>

<div class="container pb-5">
    <!-- Search and Filter Section -->
    <div class="filter-card">
        <form action="{{ route('songs.index') }}" method="GET" class="row g-3">
            <div class="col-md-4">
                <div class="input-group">
                    <span class="input-group-text bg-transparent border-end-0" style="border-color: #282828; color: #666;">
                        <i class="fas fa-search"></i>
                    </span>
                    <input type="text" name="search" class="form-control border-start-0" 
                           placeholder="Search songs, artists..." value="{{ request('search') }}" 
                           style="border-color: #282828;">
                </div>
            </div>
            <div class="col-md-3">
                <select name="category" class="form-select">
                    <option value="">All Categories</option>
                    @foreach($categories ?? [] as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <select name="sort" class="form-select">
                    <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Latest First</option>
                    <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest First</option>
                    <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>A-Z</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-filter w-100">
                    <i class="fas fa-filter me-2"></i>Filter
                </button>
            </div>
        </form>
    </div>

    <!-- Songs Grid -->
    <div class="row g-4">
        @forelse($songs as $song)
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="song-card">
                    @if($song->cover_image)
                        <div class="song-card-img">
                            <img src="{{ asset('storage/' . $song->cover_image) }}" 
                                 alt="{{ $song->title }}">
                            <div class="song-card-overlay">
                                <button class="play-btn-large" onclick="playSong('{{ $song->id }}', '{{ $song->title }}', '{{ $song->artist }}', '{{ asset('storage/' . $song->cover_image) }}')">
                                    <i class="fas fa-play"></i>
                                </button>
                            </div>
                        </div>
                    @endif
                    <div class="song-card-body" style="padding: {{ $song->cover_image ? '1.5rem' : '2rem' }};">
                        @if(!$song->cover_image)
                            <div class="text-center mb-3">
                                <i class="fas fa-music" style="font-size: 3rem; color: #1db954;"></i>
                            </div>
                        @endif
                        <h5 class="song-title" title="{{ $song->title }}">{{ $song->title }}</h5>
                        <p class="song-artist">{{ $song->artist }}</p>
                        @if($song->category)
                            <span class="song-category">{{ $song->category->name }}</span>
                        @endif
                    </div>
                    <div class="song-card-footer">
                        <button class="btn btn-play" onclick="playSong('{{ $song->id }}', '{{ $song->title }}', '{{ $song->artist }}', '{{ $song->cover_image ?? '' }}')">
                            <i class="fas fa-play me-2"></i>Play
                        </button>
                        @auth
                            <div class="dropdown">
                                <button class="btn btn-menu" type="button" data-bs-toggle="dropdown">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#addToPlaylistModal{{ $song->id }}">
                                            <i class="fas fa-plus me-2"></i>Add to Playlist
                                        </a>
                                    </li>
                                    @if(auth()->user()->isAdmin())
                                        <li><hr class="dropdown-divider" style="border-color: #282828;"></li>
                                        <li>
                                            <a class="dropdown-item" href="{{ route('songs.edit', $song) }}">
                                                <i class="fas fa-edit me-2"></i>Edit Song
                                            </a>
                                        </li>
                                        <li>
                                            <form action="{{ route('songs.destroy', $song) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item text-danger" onclick="return confirm('Are you sure?')">
                                                    <i class="fas fa-trash me-2"></i>Delete Song
                                                </button>
                                            </form>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        @endauth
                    </div>
                </div>

                <!-- Add to Playlist Modal -->
                @auth
                    <div class="modal fade" id="addToPlaylistModal{{ $song->id }}" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">
                                        <i class="fas fa-list-music me-2"></i>Add to Playlist
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    @if(auth()->user()->playlists->count() > 0)
                                        <form action="" method="POST" id="addToPlaylistForm{{ $song->id }}">
                                            @csrf
                                            <div class="mb-3">
                                                <label class="form-label">Select Playlist</label>
                                                <select name="playlist_id" class="form-select" onchange="document.getElementById('addToPlaylistForm{{ $song->id }}').action = '/playlists/' + this.value + '/songs';">
                                                    <option value="">Choose a playlist...</option>
                                                    @foreach(auth()->user()->playlists as $playlist)
                                                        <option value="{{ $playlist->id }}">{{ $playlist->name }}</option>
                                                    @endforeach
                                                </select>
                                                <input type="hidden" name="song_id" value="{{ $song->id }}">
                                            </div>
                                            <button type="submit" class="btn btn-filter w-100">
                                                <i class="fas fa-plus me-2"></i>Add to Playlist
                                            </button>
                                        </form>
                                    @else
                                        <div class="text-center py-4">
                                            <i class="fas fa-list-music fa-3x mb-3" style="color: #282828;"></i>
                                            <p class="text-muted mb-3">You don't have any playlists yet.</p>
                                            <a href="{{ route('playlists.create') }}" class="btn btn-filter">
                                                <i class="fas fa-plus me-2"></i>Create Playlist
                                            </a>
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
                <div class="empty-state">
                    <i class="fas fa-music"></i>
                    <h3>No Songs Found</h3>
                    <p>We couldn't find any songs matching your criteria.</p>
                    @auth
                        <a href="{{ route('songs.create') }}" class="btn btn-upload">
                            <i class="fas fa-cloud-upload-alt me-2"></i>Upload Your First Song
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-upload">
                            <i class="fas fa-sign-in-alt me-2"></i>Login to Upload Songs
                        </a>
                    @endauth
                </div>
            </div>
        @endforelse
    </div>
</div>

<!-- Fixed Bottom Audio Player -->
<div id="audioPlayerBar" style="display: none; position: fixed; bottom: 0; left: 0; right: 0; background: rgba(0, 0, 0, 0.95); backdrop-filter: blur(10px); border-top: 1px solid #282828; padding: 1rem; z-index: 1000;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-3">
                <div class="d-flex align-items-center gap-3">
                    <div id="playerCoverContainer" style="width: 60px; height: 60px; border-radius: 8px; background: linear-gradient(135deg, #1db954, #1ed760); display: flex; align-items: center; justify-content: center; overflow: hidden;">
                        <i class="fas fa-music" id="playerMusicIcon" style="font-size: 1.5rem; color: white;"></i>
                        <img id="playerCoverImage" src="" alt="" style="width: 100%; height: 100%; object-fit: cover; display: none;">
                    </div>
                    <div>
                        <div id="playerSongTitle" style="color: #ffffff; font-weight: 600; font-size: 0.95rem;"></div>
                        <div id="playerArtist" style="color: #b3b3b3; font-size: 0.85rem;"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="d-flex flex-column gap-2">
                    <div class="d-flex justify-content-center align-items-center gap-3">
                        <button onclick="previousSong()" style="background: none; border: none; color: #b3b3b3; font-size: 1.2rem; cursor: pointer;">
                            <i class="fas fa-step-backward"></i>
                        </button>
                        <button id="mainPlayBtn" onclick="togglePlay()" style="width: 40px; height: 40px; border-radius: 50%; background: #1db954; border: none; color: white; font-size: 1rem; cursor: pointer;">
                            <i class="fas fa-play" id="mainPlayIcon"></i>
                        </button>
                        <button onclick="nextSong()" style="background: none; border: none; color: #b3b3b3; font-size: 1.2rem; cursor: pointer;">
                            <i class="fas fa-step-forward"></i>
                        </button>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <span id="currentTime" style="color: #b3b3b3; font-size: 0.75rem; min-width: 40px;">0:00</span>
                        <div style="flex: 1; height: 4px; background: rgba(255,255,255,0.1); border-radius: 2px; cursor: pointer; position: relative;" id="progressBar" onclick="seekAudio(event)">
                            <div id="progressFill" style="height: 100%; background: #1db954; border-radius: 2px; width: 0%; position: relative;">
                                <div style="position: absolute; right: -6px; top: 50%; transform: translateY(-50%); width: 12px; height: 12px; background: white; border-radius: 50%;"></div>
                            </div>
                        </div>
                        <span id="duration" style="color: #b3b3b3; font-size: 0.75rem; min-width: 40px;">0:00</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="d-flex justify-content-end align-items-center gap-2">
                    <i class="fas fa-volume-down" style="color: #b3b3b3;"></i>
                    <input type="range" id="volumeSlider" min="0" max="100" value="70" style="width: 100px;" oninput="changeVolume(this.value)">
                    <i class="fas fa-volume-up" style="color: #b3b3b3;"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<audio id="audioPlayer" preload="metadata"></audio>

<script>
const audioPlayer = document.getElementById('audioPlayer');
const audioPlayerBar = document.getElementById('audioPlayerBar');
const mainPlayBtn = document.getElementById('mainPlayBtn');
const mainPlayIcon = document.getElementById('mainPlayIcon');
const progressFill = document.getElementById('progressFill');
const currentTimeDisplay = document.getElementById('currentTime');
const durationDisplay = document.getElementById('duration');

let currentSongId = null;

function playSong(songId, title, artist, coverImage) {
    // Sample audio URL (replace with actual song file path)
    const audioUrl = 'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-1.mp3';
    
    // Update player info
    document.getElementById('playerSongTitle').textContent = title;
    document.getElementById('playerArtist').textContent = artist;
    
    // Update cover image
    const playerCoverImage = document.getElementById('playerCoverImage');
    const playerMusicIcon = document.getElementById('playerMusicIcon');
    
    if (coverImage && coverImage.trim() !== '') {
        playerCoverImage.src = coverImage;
        playerCoverImage.style.display = 'block';
        playerMusicIcon.style.display = 'none';
    } else {
        playerCoverImage.style.display = 'none';
        playerMusicIcon.style.display = 'block';
    }
    
    // Show player bar
    audioPlayerBar.style.display = 'block';
    
    // Load and play audio
    if (currentSongId !== songId) {
        audioPlayer.src = audioUrl;
        currentSongId = songId;
    }
    
    audioPlayer.play();
    mainPlayIcon.classList.remove('fa-play');
    mainPlayIcon.classList.add('fa-pause');
    
    // Update all play icons
    document.querySelectorAll('[id^="playIcon"]').forEach(icon => {
        icon.classList.remove('fa-pause');
        icon.classList.add('fa-play');
    });
    document.getElementById('playIcon' + songId).classList.remove('fa-play');
    document.getElementById('playIcon' + songId).classList.add('fa-pause');
}

function togglePlay() {
    if (audioPlayer.paused) {
        audioPlayer.play();
        mainPlayIcon.classList.remove('fa-play');
        mainPlayIcon.classList.add('fa-pause');
    } else {
        audioPlayer.pause();
        mainPlayIcon.classList.remove('fa-pause');
        mainPlayIcon.classList.add('fa-play');
    }
}

function changeVolume(value) {
    audioPlayer.volume = value / 100;
}

function seekAudio(event) {
    const progressBar = document.getElementById('progressBar');
    const rect = progressBar.getBoundingClientRect();
    const percent = (event.clientX - rect.left) / rect.width;
    audioPlayer.currentTime = percent * audioPlayer.duration;
}

function formatTime(seconds) {
    const mins = Math.floor(seconds / 60);
    const secs = Math.floor(seconds % 60);
    return `${mins}:${secs < 10 ? '0' : ''}${secs}`;
}

function previousSong() {
    audioPlayer.currentTime = 0;
}

function nextSong() {
    // Implement next song logic
    alert('Next song feature coming soon!');
}

// Update progress
audioPlayer.addEventListener('timeupdate', () => {
    const progress = (audioPlayer.currentTime / audioPlayer.duration) * 100;
    progressFill.style.width = progress + '%';
    currentTimeDisplay.textContent = formatTime(audioPlayer.currentTime);
});

// Update duration
audioPlayer.addEventListener('loadedmetadata', () => {
    durationDisplay.textContent = formatTime(audioPlayer.duration);
});

// Set initial volume
audioPlayer.volume = 0.7;
</script>
@endsection