@extends('layouts.app')

@section('content')
<style>
    .song-player-container {
        background: linear-gradient(135deg, rgba(29, 185, 84, 0.1), rgba(0, 0, 0, 0.3));
        min-height: 100vh;
        padding: 3rem 0;
    }

    .player-card {
        background: rgba(30, 30, 30, 0.95);
        border: 1px solid #282828;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
        backdrop-filter: blur(10px);
    }

    .album-art-container {
        position: relative;
        padding: 2rem;
        background: linear-gradient(135deg, rgba(29, 185, 84, 0.05), transparent);
    }

    .album-art {
        width: 100%;
        max-width: 400px;
        height: 400px;
        object-fit: cover;
        border-radius: 15px;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.4);
        margin: 0 auto;
        display: block;
        animation: fadeIn 0.5s ease;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: scale(0.95);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    .song-info {
        padding: 2rem;
        text-align: center;
    }

    .song-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: #ffffff;
        margin-bottom: 0.5rem;
        background: linear-gradient(135deg, #ffffff, #b3b3b3);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .song-artist {
        font-size: 1.5rem;
        color: #b3b3b3;
        margin-bottom: 1rem;
    }

    .song-meta {
        display: flex;
        justify-content: center;
        gap: 2rem;
        margin-top: 1.5rem;
        flex-wrap: wrap;
    }

    .meta-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 1rem;
        background: rgba(29, 185, 84, 0.1);
        border: 1px solid rgba(29, 185, 84, 0.3);
        border-radius: 25px;
        color: #1db954;
        font-size: 0.9rem;
    }

    .meta-item i {
        font-size: 1.1rem;
    }

    /* Custom Audio Player */
    .custom-audio-player {
        padding: 2rem;
        background: rgba(0, 0, 0, 0.3);
        border-top: 1px solid #282828;
    }

    .audio-controls {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 1.5rem;
        margin-bottom: 1.5rem;
    }

    .control-btn {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        border: none;
        background: rgba(255, 255, 255, 0.1);
        color: #ffffff;
        font-size: 1.2rem;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .control-btn:hover {
        background: rgba(29, 185, 84, 0.2);
        color: #1db954;
        transform: scale(1.1);
    }

    .play-btn {
        width: 70px;
        height: 70px;
        background: linear-gradient(135deg, #1db954, #1ed760);
        font-size: 1.8rem;
        box-shadow: 0 5px 20px rgba(29, 185, 84, 0.4);
    }

    .play-btn:hover {
        background: linear-gradient(135deg, #1ed760, #1db954);
        transform: scale(1.1);
        box-shadow: 0 8px 30px rgba(29, 185, 84, 0.6);
    }

    .progress-container {
        margin-bottom: 1rem;
    }

    .progress-bar-custom {
        width: 100%;
        height: 6px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 3px;
        cursor: pointer;
        position: relative;
        overflow: hidden;
    }

    .progress-bar-fill {
        height: 100%;
        background: linear-gradient(90deg, #1db954, #1ed760);
        border-radius: 3px;
        width: 0%;
        transition: width 0.1s linear;
        position: relative;
    }

    .progress-bar-fill::after {
        content: '';
        position: absolute;
        right: 0;
        top: 50%;
        transform: translateY(-50%);
        width: 12px;
        height: 12px;
        background: #ffffff;
        border-radius: 50%;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
    }

    .time-display {
        display: flex;
        justify-content: space-between;
        color: #b3b3b3;
        font-size: 0.85rem;
        margin-top: 0.5rem;
    }

    .volume-control {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 1rem;
        margin-top: 1.5rem;
    }

    .volume-slider {
        width: 150px;
        height: 4px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 2px;
        outline: none;
        -webkit-appearance: none;
    }

    .volume-slider::-webkit-slider-thumb {
        -webkit-appearance: none;
        width: 12px;
        height: 12px;
        background: #1db954;
        border-radius: 50%;
        cursor: pointer;
    }

    .action-buttons {
        display: flex;
        justify-content: center;
        gap: 1rem;
        padding: 1.5rem 2rem;
        border-top: 1px solid #282828;
    }

    .action-btn {
        padding: 0.75rem 1.5rem;
        border-radius: 25px;
        border: 1px solid #282828;
        background: rgba(255, 255, 255, 0.05);
        color: #ffffff;
        font-weight: 500;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .action-btn:hover {
        background: rgba(29, 185, 84, 0.1);
        border-color: #1db954;
        color: #1db954;
        transform: translateY(-2px);
    }

    .action-btn-primary {
        background: linear-gradient(135deg, #1db954, #1ed760);
        border: none;
        color: #ffffff;
    }

    .action-btn-primary:hover {
        background: linear-gradient(135deg, #1ed760, #1db954);
        color: #ffffff;
    }

    .back-btn {
        position: absolute;
        top: 2rem;
        left: 2rem;
        padding: 0.75rem 1.5rem;
        background: rgba(0, 0, 0, 0.5);
        border: 1px solid #282828;
        border-radius: 25px;
        color: #ffffff;
        text-decoration: none;
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .back-btn:hover {
        background: rgba(29, 185, 84, 0.2);
        border-color: #1db954;
        color: #1db954;
    }

    @media (max-width: 768px) {
        .song-title {
            font-size: 1.8rem;
        }

        .song-artist {
            font-size: 1.2rem;
        }

        .album-art {
            height: 300px;
        }

        .song-meta {
            gap: 1rem;
        }

        .back-btn {
            top: 1rem;
            left: 1rem;
        }
    }
</style>

<div class="song-player-container">
    <div class="container">
        <a href="{{ route('songs.index') }}" class="back-btn">
            <i class="fas fa-arrow-left"></i>
            <span>Back to Songs</span>
        </a>

        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="player-card">
                    <!-- Album Art -->
                    <div class="album-art-container">
                        <img src="{{ $song->cover_image ?? 'https://via.placeholder.com/400x400/1db954/ffffff?text=No+Image' }}"
                             class="album-art" alt="{{ $song->title }}" id="albumArt">
                    </div>

                    <!-- Song Info -->
                    <div class="song-info">
                        <h1 class="song-title">{{ $song->title }}</h1>
                        <p class="song-artist">{{ $song->artist }}</p>

                        <div class="song-meta">
                            @if($song->category)
                                <div class="meta-item">
                                    <i class="fas fa-tag"></i>
                                    <span>{{ $song->category->name }}</span>
                                </div>
                            @endif
                            @if($song->album)
                                <div class="meta-item">
                                    <i class="fas fa-compact-disc"></i>
                                    <span>{{ $song->album }}</span>
                                </div>
                            @endif
                            <div class="meta-item">
                                <i class="fas fa-clock"></i>
                                <span id="totalDuration">{{ gmdate('i:s', $song->duration ?? 0) }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Audio Player -->
                    <div class="custom-audio-player">
                        <!-- Hidden HTML5 Audio Element -->
                        <audio id="audioPlayer" preload="metadata">
                            <source src="https://www.soundhelix.com/examples/mp3/SoundHelix-Song-1.mp3" type="audio/mpeg">
                            Your browser does not support the audio element.
                        </audio>

                        <!-- Custom Controls -->
                        <div class="audio-controls">
                            <button class="control-btn" id="prevBtn" title="Previous">
                                <i class="fas fa-step-backward"></i>
                            </button>
                            <button class="control-btn play-btn" id="playPauseBtn" title="Play">
                                <i class="fas fa-play" id="playIcon"></i>
                            </button>
                            <button class="control-btn" id="nextBtn" title="Next">
                                <i class="fas fa-step-forward"></i>
                            </button>
                        </div>

                        <!-- Progress Bar -->
                        <div class="progress-container">
                            <div class="progress-bar-custom" id="progressBar">
                                <div class="progress-bar-fill" id="progressFill"></div>
                            </div>
                            <div class="time-display">
                                <span id="currentTime">0:00</span>
                                <span id="duration">0:00</span>
                            </div>
                        </div>

                        <!-- Volume Control -->
                        <div class="volume-control">
                            <i class="fas fa-volume-down" style="color: #b3b3b3;"></i>
                            <input type="range" class="volume-slider" id="volumeSlider" min="0" max="100" value="70">
                            <i class="fas fa-volume-up" style="color: #b3b3b3;"></i>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="action-buttons">
                        @auth
                            <button class="action-btn action-btn-primary" data-bs-toggle="modal" data-bs-target="#addToPlaylistModal">
                                <i class="fas fa-plus"></i>
                                <span>Add to Playlist</span>
                            </button>
                            @if(auth()->user()->isAdmin())
                                <a href="{{ route('songs.edit', $song) }}" class="action-btn">
                                    <i class="fas fa-edit"></i>
                                    <span>Edit</span>
                                </a>
                                <form action="{{ route('songs.destroy', $song) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-btn" onclick="return confirm('Are you sure?')">
                                        <i class="fas fa-trash"></i>
                                        <span>Delete</span>
                                    </button>
                                </form>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="action-btn action-btn-primary">
                                <i class="fas fa-sign-in-alt"></i>
                                <span>Login to Add to Playlist</span>
                            </a>
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
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="background: #1e1e1e; border: 1px solid #282828; border-radius: 15px;">
                <div class="modal-header" style="border-bottom: 1px solid #282828;">
                    <h5 class="modal-title" style="color: #ffffff;">
                        <i class="fas fa-list-music me-2"></i>Add to Playlist
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" style="filter: invert(1);"></button>
                </div>
                <div class="modal-body">
                    @if(auth()->user()->playlists->count() > 0)
                        <form action="" method="POST" id="addToPlaylistFormShow">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label" style="color: #ffffff;">Select Playlist</label>
                                <select name="playlist_id" class="form-select" style="background: rgba(0,0,0,0.4); border: 1px solid #282828; color: #ffffff;" onchange="document.getElementById('addToPlaylistFormShow').action = '/playlists/' + this.value + '/songs';">
                                    <option value="">Choose a playlist...</option>
                                    @foreach(auth()->user()->playlists as $playlist)
                                        <option value="{{ $playlist->id }}">{{ $playlist->name }}</option>
                                    @endforeach
                                </select>
                                <input type="hidden" name="song_id" value="{{ $song->id }}">
                            </div>
                            <button type="submit" class="btn w-100" style="background: linear-gradient(135deg, #1db954, #1ed760); color: white; border: none; padding: 0.75rem; border-radius: 10px; font-weight: 600;">
                                <i class="fas fa-plus me-2"></i>Add to Playlist
                            </button>
                        </form>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-list-music fa-3x mb-3" style="color: #282828;"></i>
                            <p style="color: #b3b3b3;" class="mb-3">You don't have any playlists yet.</p>
                            <a href="{{ route('playlists.create') }}" class="btn" style="background: linear-gradient(135deg, #1db954, #1ed760); color: white; border: none; padding: 0.75rem 2rem; border-radius: 25px; font-weight: 600;">
                                <i class="fas fa-plus me-2"></i>Create Playlist
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endauth

<script>
    // Audio Player Functionality
    const audio = document.getElementById('audioPlayer');
    const playPauseBtn = document.getElementById('playPauseBtn');
    const playIcon = document.getElementById('playIcon');
    const progressBar = document.getElementById('progressBar');
    const progressFill = document.getElementById('progressFill');
    const currentTimeDisplay = document.getElementById('currentTime');
    const durationDisplay = document.getElementById('duration');
    const volumeSlider = document.getElementById('volumeSlider');
    const albumArt = document.getElementById('albumArt');

    // Set initial volume
    audio.volume = 0.7;

    // Play/Pause
    playPauseBtn.addEventListener('click', () => {
        if (audio.paused) {
            audio.play();
            playIcon.classList.remove('fa-play');
            playIcon.classList.add('fa-pause');
            albumArt.style.animation = 'none';
            setTimeout(() => {
                albumArt.style.animation = 'fadeIn 0.5s ease';
            }, 10);
        } else {
            audio.pause();
            playIcon.classList.remove('fa-pause');
            playIcon.classList.add('fa-play');
        }
    });

    // Update progress bar
    audio.addEventListener('timeupdate', () => {
        const progress = (audio.currentTime / audio.duration) * 100;
        progressFill.style.width = progress + '%';
        currentTimeDisplay.textContent = formatTime(audio.currentTime);
    });

    // Update duration when loaded
    audio.addEventListener('loadedmetadata', () => {
        durationDisplay.textContent = formatTime(audio.duration);
    });

    // Seek functionality
    progressBar.addEventListener('click', (e) => {
        const rect = progressBar.getBoundingClientRect();
        const percent = (e.clientX - rect.left) / rect.width;
        audio.currentTime = percent * audio.duration;
    });

    // Volume control
    volumeSlider.addEventListener('input', (e) => {
        audio.volume = e.target.value / 100;
    });

    // Format time helper
    function formatTime(seconds) {
        const mins = Math.floor(seconds / 60);
        const secs = Math.floor(seconds % 60);
        return `${mins}:${secs < 10 ? '0' : ''}${secs}`;
    }

    // Previous/Next buttons (placeholder)
    document.getElementById('prevBtn').addEventListener('click', () => {
        audio.currentTime = 0;
    });

    document.getElementById('nextBtn').addEventListener('click', () => {
        // Navigate to next song (implement as needed)
        alert('Next song feature coming soon!');
    });

    // Auto-play on load (optional)
    // audio.play();
</script>
@endsection
