<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'WaveStream') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
        :root {
            --primary-color: #1db954;
            --dark-bg: #000000;
            --card-bg: #121212;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #121212;
            color: #ffffff;
        }

        /* Modern Navbar Styles */
        .navbar {
            background: rgba(0, 0, 0, 0.95);
            backdrop-filter: blur(10px);
            padding: 1rem 0;
            border-bottom: 1px solid rgba(29, 185, 84, 0.1);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar-brand {
            font-size: 1.8rem;
            font-weight: 700;
            color: #ffffff;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
        }

        .navbar-brand:hover {
            color: var(--primary-color);
            transform: scale(1.05);
        }

        .navbar-brand i {
            font-size: 2rem;
            background: linear-gradient(135deg, var(--primary-color), #1ed760);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: pulse 2s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.1);
            }
        }

        .navbar-brand-text {
            background: linear-gradient(135deg, #ffffff, #b3b3b3);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            letter-spacing: -0.5px;
        }

        .navbar-toggler {
            border: 2px solid var(--primary-color);
            padding: 0.5rem 0.75rem;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .navbar-toggler:hover {
            background: rgba(29, 185, 84, 0.1);
            transform: scale(1.05);
        }

        .navbar-toggler:focus {
            box-shadow: 0 0 0 3px rgba(29, 185, 84, 0.2);
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='%231db954' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }

        .nav-link {
            color: #b3b3b3;
            font-weight: 500;
            font-size: 1rem;
            padding: 0.75rem 1.25rem !important;
            margin: 0 0.25rem;
            border-radius: 8px;
            transition: all 0.3s ease;
            position: relative;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .nav-link::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, var(--primary-color), #1ed760);
            transition: width 0.3s ease;
        }

        .nav-link:hover {
            color: #ffffff;
            background: rgba(29, 185, 84, 0.1);
            transform: translateY(-2px);
        }

        .nav-link:hover::before {
            width: 80%;
        }

        .nav-link.active {
            color: var(--primary-color);
            background: rgba(29, 185, 84, 0.15);
        }

        .nav-link i {
            font-size: 1.1rem;
        }

        .btn-nav {
            background: transparent;
            border: 2px solid var(--primary-color);
            color: var(--primary-color);
            padding: 0.6rem 1.5rem;
            border-radius: 25px;
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            margin: 0 0.25rem;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-nav:hover {
            background: var(--primary-color);
            color: #000000;
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(29, 185, 84, 0.4);
        }

        .btn-nav-primary {
            background: linear-gradient(135deg, var(--primary-color), #1ed760);
            border: none;
            color: #ffffff;
            box-shadow: 0 4px 15px rgba(29, 185, 84, 0.3);
        }

        .btn-nav-primary:hover {
            background: linear-gradient(135deg, #1ed760, var(--primary-color));
            color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 6px 25px rgba(29, 185, 84, 0.5);
        }

        .btn-link {
            background: transparent;
            border: none;
            color: #b3b3b3;
            padding: 0.75rem 1.25rem;
            font-weight: 500;
            transition: all 0.3s ease;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-link:hover {
            color: #ff6b6b;
            background: rgba(255, 107, 107, 0.1);
            transform: translateY(-2px);
        }

        .navbar-nav {
            align-items: center;
            gap: 0.5rem;
        }

        /* User Badge */
        .user-badge {
            background: rgba(29, 185, 84, 0.1);
            border: 1px solid rgba(29, 185, 84, 0.3);
            padding: 0.5rem 1rem;
            border-radius: 25px;
            color: var(--primary-color);
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin: 0 0.5rem;
        }

        .user-badge i {
            font-size: 1.2rem;
        }

        /* Mobile Responsive */
        @media (max-width: 991px) {
            .navbar-nav {
                padding: 1rem 0;
                gap: 0.5rem;
            }

            .nav-link {
                margin: 0.25rem 0;
            }

            .btn-nav {
                width: 100%;
                justify-content: center;
                margin: 0.25rem 0;
            }

            .user-badge {
                width: 100%;
                justify-content: center;
                margin: 0.5rem 0;
            }
        }

        .card {
            background-color: #181818;
            border: none;
            border-radius: 8px;
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .btn-primary {
            background-color: #1DB954;
            border-color: #1DB954;
        }

        .btn-primary:hover {
            background-color: #1ed760;
            border-color: #1ed760;
        }

        .footer {
            background-color: #000000;
            padding: 2rem 0;
            margin-top: 3rem;
        }

        .social-icons a {
            color: #ffffff;
            margin: 0 10px;
            font-size: 1.2rem;
            transition: color 0.3s ease;
        }

        .social-icons a:hover {
            color: #1DB954;
        }
    </style>

    @stack('styles')
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <i class="fas fa-music"></i>
                <span class="navbar-brand-text">WaveStream</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ url('/') }}">
                            <i class="fas fa-home"></i>
                            <span>Home</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('songs.*') ? 'active' : '' }}" href="{{ route('songs.index') }}">
                            <i class="fas fa-music"></i>
                            <span>Songs</span>
                        </a>
                    </li>
                    @auth
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('playlists.*') ? 'active' : '' }}" href="{{ route('playlists.index') }}">
                                <i class="fas fa-list-ul"></i>
                                <span>My Playlists</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <span class="user-badge">
                                <i class="fas fa-user-circle"></i>
                                <span>{{ auth()->user()->name }}</span>
                            </span>
                        </li>
                        <li class="nav-item">
                            <form method="POST" action="{{ auth()->user()->isAdmin() ? route('admin.logout') : route('logout') }}" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-link">
                                    <i class="fas fa-sign-out-alt"></i>
                                    <span>Logout</span>
                                </button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item">
                            <a href="{{ route('login') }}" class="btn btn-nav">
                                <i class="fas fa-sign-in-alt"></i>
                                <span>Login</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('register') }}" class="btn btn-nav btn-nav-primary">
                                <i class="fas fa-user-plus"></i>
                                <span>Register</span>
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-md-start">
                    <p>&copy; {{ date('Y') }} wavestream. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <div class="social-icons">
                        <a href="#"><i class="fab fa-facebook"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html> 