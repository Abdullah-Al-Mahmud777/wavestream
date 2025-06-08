@extends('layouts.app')

@section('content')
<style>
    :root {
        --primary-color: #1DB954;
        --secondary-color: #191414;
        --accent-color: #FFFFFF;
        --gradient-start: #1DB954;
        --gradient-middle: #1ed760;
        --gradient-end: #1DB954;
    }

    .hero-section {
        background: linear-gradient(135deg, rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.2)),
                    url('https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        min-height: 100vh;
        display: flex;
        align-items: center;
        margin-bottom: 5rem;
        position: relative;
        overflow: hidden;
    }

    .hero-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: radial-gradient(circle at center, transparent 0%, rgba(25, 20, 20, 0.3) 100%);
        opacity: 0.4;
    }

    .hero-content {
        position: relative;
        z-index: 2;
        animation: fadeInUp 1.2s ease;
        text-shadow: 0 2px 4px rgba(0,0,0,0.2);
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(40px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .hero-title {
        font-size: 5rem;
        font-weight: 900;
        background: linear-gradient(45deg, var(--gradient-start), var(--gradient-middle), var(--gradient-end));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: 1.5rem;
        text-shadow: 0 2px 10px rgba(0,0,0,0.1);
        letter-spacing: -1px;
    }

    .hero-subtitle {
        font-size: 1.8rem;
        color: var(--accent-color);
        margin-bottom: 3rem;
        opacity: 0.98;
        font-weight: 300;
        letter-spacing: 0.5px;
    }

    .hero-buttons {
        display: flex;
        gap: 1.5rem;
        justify-content: center;
    }

    .btn-primary {
        background: linear-gradient(45deg, var(--gradient-start), var(--gradient-middle));
        border: none;
        padding: 1rem 2.5rem;
        border-radius: 50px;
        font-weight: 600;
        letter-spacing: 0.5px;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        box-shadow: 0 4px 15px rgba(29, 185, 84, 0.3);
        text-transform: uppercase;
        font-size: 1.1rem;
    }

    .btn-primary:hover {
        background: linear-gradient(45deg, var(--gradient-middle), var(--gradient-start));
        transform: translateY(-3px) scale(1.02);
        box-shadow: 0 8px 25px rgba(29, 185, 84, 0.4);
    }

    .btn-outline-light {
        border: 2px solid var(--accent-color);
        border-radius: 50px;
        padding: 1rem 2.5rem;
        font-weight: 600;
        letter-spacing: 0.5px;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        text-transform: uppercase;
        font-size: 1.1rem;
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(5px);
    }

    .btn-outline-light:hover {
        background: var(--accent-color);
        color: var(--secondary-color);
        transform: translateY(-3px) scale(1.02);
        box-shadow: 0 8px 25px rgba(255, 255, 255, 0.2);
    }

    .music-note {
        position: absolute;
        font-size: 2rem;
        color: var(--primary-color);
        opacity: 0.5;
        animation: float 3s ease-in-out infinite;
    }

    .music-note:nth-child(1) {
        top: 20%;
        left: 10%;
        animation-delay: 0s;
    }

    .music-note:nth-child(2) {
        top: 40%;
        right: 15%;
        animation-delay: 1s;
    }

    .music-note:nth-child(3) {
        bottom: 30%;
        left: 20%;
        animation-delay: 2s;
    }

    @keyframes float {
        0%, 100% {
            transform: translateY(0) rotate(0deg);
        }
        50% {
            transform: translateY(-20px) rotate(10deg);
        }
    }

    @media (max-width: 768px) {
        .hero-title {
            font-size: 3rem;
        }

        .hero-subtitle {
            font-size: 1.3rem;
        }

        .hero-buttons {
            flex-direction: column;
            gap: 1rem;
        }

        .btn-primary, .btn-outline-light {
            width: 100%;
            text-align: center;
        }
    }

    .card {
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        border: none;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        background: rgba(255, 255, 255, 0.05);
        backdrop-filter: blur(10px);
    }

    .card:hover {
        transform: translateY(-15px) scale(1.02);
        box-shadow: 0 15px 30px rgba(0,0,0,0.3);
    }

    .card-img-top {
        height: 220px;
        object-fit: cover;
        transition: transform 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    .card:hover .card-img-top {
        transform: scale(1.1);
    }

    .card-body {
        padding: 1.8rem;
    }

    .card-title {
        font-size: 1.2rem;
        font-weight: 600;
        margin-bottom: 0.8rem;
        color: var(--accent-color);
    }

    .card-text {
        color: rgba(255, 255, 255, 0.7);
        font-size: 0.9rem;
    }

    .section-title {
        position: relative;
        padding-bottom: 1.2rem;
        margin-bottom: 3rem;
        font-size: 2.5rem;
        font-weight: 700;
    }

    .section-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 60px;
        height: 4px;
        background: linear-gradient(45deg, var(--primary-color), #1ed760);
        border-radius: 2px;
    }

    .featured-section {
        padding: 2rem 0;
        background: rgba(0, 0, 0, 0.3);
        backdrop-filter: blur(10px);
    }

    .featured-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 1.5rem;
        padding: 1rem;
    }

    .featured-card {
        background: rgba(255, 255, 255, 0.05);
        border-radius: 12px;
        overflow: hidden;
        transition: transform 0.3s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .featured-card:hover {
        transform: translateY(-5px);
    }

    .featured-card img {
        width: 100%;
        height: 180px;
        object-fit: cover;
    }

    .featured-card-body {
        padding: 1rem;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .featured-card-title {
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
        color: var(--accent-color);
    }

    .featured-card-text {
        font-size: 0.9rem;
        color: rgba(255, 255, 255, 0.7);
        margin-bottom: 1rem;
    }

    .featured-card-footer {
        margin-top: auto;
        padding-top: 1rem;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
    }

    .section-title {
        font-size: 2rem;
        margin-bottom: 2rem;
        text-align: center;
        color: var(--accent-color);
    }

    @media (max-width: 768px) {
        .featured-grid {
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 1rem;
        }

        .featured-card img {
            height: 150px;
        }
    }
</style>

<div class="hero-section">
    <i class="fas fa-music music-note"></i>
    <i class="fas fa-headphones music-note"></i>
    <i class="fas fa-play-circle music-note"> </i>

    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto text-center hero-content">
                <h1 class="hero-title">Welcome to wavestream</h1>
                <p class="hero-subtitle">Discover and enjoy your favorite music in one place</p>

                <div class="hero-buttons">
                    <a href="{{ route('songs.index') }}" class="btn btn-primary">
                        <i class="fas fa-music me-2"></i>Browse Songs
                    </a>
                    @auth
                        <a href="{{ route('playlists.index') }}" class="btn btn-outline-light">
                            <i class="fas fa-list me-2"></i>My Playlists
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline-light">
                            <i class="fas fa-sign-in-alt me-2"></i>Login
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Featured Section -->
<section class="featured-section">
    <div class="container">
        <h2 class="section-title">Featured Songs</h2>
        <div class="featured-grid">
            @foreach($featuredSongs as $song)
                <div class="featured-card">
                    <img src="{{ $song->cover_image ? asset('storage/' . $song->cover_image) : asset('images/default-album.png') }}"
                         alt="{{ $song->title }}" class="card-img-top">
                    <div class="featured-card-body">
                        <h5 class="featured-card-title">{{ $song->title }}</h5>
                        <p class="featured-card-text">{{ $song->artist }}</p>
                        <div class="featured-card-footer">
                            <a href="{{ route('songs.show', $song) }}" class="btn btn-sm btn-primary w-100">
                                <i class="fas fa-play me-2"></i>Play Now
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<div class="feedback-section py-5" style="background: linear-gradient(135deg, var(--secondary-color), #000);">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card bg-dark text-white border-0 shadow-lg">
                    <div class="card-body p-5">
                        <h2 class="text-center mb-4 section-title">Send Us Your Feedback</h2>
                        <p class="text-center text-muted mb-4">We value your opinion! Help us improve by sharing your thoughts.</p>

                        <form action="{{ route('feedback.store') }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label for="name" class="form-label">Your Name</label>
                                <input type="text" class="form-control bg-dark text-white border-secondary @error('name') is-invalid @enderror"
                                       id="name" name="name" value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control bg-dark text-white border-secondary @error('email') is-invalid @enderror"
                                       id="email" name="email" value="{{ old('email') }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="message" class="form-label">Your Message</label>
                                <textarea class="form-control bg-dark text-white border-secondary @error('message') is-invalid @enderror"
                                          id="message" name="message" rows="5" required>{{ old('message') }}</textarea>
                                @error('message')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-lg px-5">
                                    <i class="fas fa-paper-plane me-2"></i>Send Feedback
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- New Feedback Messages Section -->
<div class="feedback-messages py-5" style="background: linear-gradient(135deg, #000, var(--secondary-color));">
    <div class="container">
        <h2 class="text-center mb-4 section-title">Recent Feedback</h2>
        <p class="text-center text-muted mb-5">What our users are saying about us</p>

        <div class="row">
            @foreach($recentFeedback as $feedback)
                <div class="col-md-4 mb-4">
                    <div class="card bg-dark text-white border-0 shadow-lg h-100">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center mb-3">
                                <div class="feedback-avatar me-3">
                                    <i class="fas fa-user-circle fa-2x text-primary"></i>
                                </div>
                                <div>
                                    <h5 class="mb-0">{{ $feedback->name }}</h5>
                                    <small class="text-muted">{{ $feedback->created_at->format('M d, Y') }}</small>
                                </div>
                            </div>
                            <p class="card-text">{{ Str::limit($feedback->message, 150) }}</p>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <small class="text-muted">{{ $feedback->email }}</small>
                                <span class="badge bg-primary">{{ $feedback->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @if($recentFeedback->isEmpty())
            <div class="text-center text-muted">
                <i class="fas fa-comments fa-3x mb-3"></i>
                <p>No feedback messages yet. Be the first to share your thoughts!</p>
            </div>
        @endif
    </div>
</div>

<style>
    .feedback-section {
        position: relative;
        overflow: hidden;
    }

    .feedback-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100"><rect width="100" height="100" fill="none"/><path d="M0 0 L100 100 M100 0 L0 100" stroke="rgba(29,185,84,0.1)" stroke-width="1"/></svg>');
        opacity: 0.1;
    }

    .form-control {
        transition: all 0.3s ease;
    }

    .form-control:focus {
        background-color: rgba(0, 0, 0, 0.3);
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.25rem rgba(29, 185, 84, 0.25);
    }

    .form-control::placeholder {
        color: rgba(255, 255, 255, 0.5);
    }

    .section-title {
        position: relative;
        padding-bottom: 1.2rem;
        margin-bottom: 2rem;
    }

    .section-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 60px;
        height: 4px;
        background: linear-gradient(45deg, var(--primary-color), #1ed760);
        border-radius: 2px;
    }

    .feedback-messages {
        position: relative;
        overflow: hidden;
    }

    .feedback-messages::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100"><rect width="100" height="100" fill="none"/><path d="M0 0 L100 100 M100 0 L0 100" stroke="rgba(29,185,84,0.1)" stroke-width="1"/></svg>');
        opacity: 0.1;
    }

    .feedback-avatar {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(29, 185, 84, 0.1);
        border-radius: 50%;
    }

    .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.3);
    }

    .badge {
        font-size: 0.75rem;
        padding: 0.35em 0.65em;
    }
</style>
@endsection