<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin Dashboard - {{ config('app.name', 'WaveStream') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <style>
        :root {
            --primary-color: #1db954;
            --sidebar-bg: #000000;
            --sidebar-hover: #1a1a1a;
            --main-bg: #121212;
            --card-bg: #1e1e1e;
            --text-primary: #ffffff;
            --text-secondary: #b3b3b3;
            --border-color: #282828;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--main-bg);
            color: var(--text-primary);
            overflow-x: hidden;
        }

        /* Sidebar Styles */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 260px;
            background: var(--sidebar-bg);
            padding: 0;
            z-index: 1000;
            transition: all 0.3s ease;
            overflow-y: auto;
            border-right: 1px solid var(--border-color);
        }

        .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: var(--sidebar-bg);
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: var(--border-color);
            border-radius: 3px;
        }

        .sidebar-header {
            padding: 25px 20px;
            border-bottom: 1px solid var(--border-color);
            background: linear-gradient(135deg, rgba(29, 185, 84, 0.1), transparent);
        }

        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: var(--text-primary);
        }

        .sidebar-brand-icon {
            width: 45px;
            height: 45px;
            background: linear-gradient(135deg, var(--primary-color), #1ed760);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            box-shadow: 0 4px 15px rgba(29, 185, 84, 0.3);
        }

        .sidebar-brand-text {
            font-size: 22px;
            font-weight: 700;
            letter-spacing: -0.5px;
        }

        .sidebar-brand-subtitle {
            font-size: 11px;
            color: var(--text-secondary);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-top: -3px;
        }

        .sidebar-menu {
            padding: 20px 0;
        }

        .menu-section-title {
            padding: 15px 20px 10px;
            font-size: 11px;
            font-weight: 600;
            color: var(--text-secondary);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .menu-item {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: var(--text-secondary);
            text-decoration: none;
            transition: all 0.3s ease;
            position: relative;
            margin: 2px 10px;
            border-radius: 8px;
        }

        .menu-item:hover {
            background: var(--sidebar-hover);
            color: var(--text-primary);
            transform: translateX(5px);
        }

        .menu-item.active {
            background: linear-gradient(90deg, rgba(29, 185, 84, 0.15), transparent);
            color: var(--primary-color);
            font-weight: 500;
        }

        .menu-item.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 3px;
            background: var(--primary-color);
            border-radius: 0 3px 3px 0;
        }

        .menu-item i {
            width: 24px;
            font-size: 18px;
            margin-right: 12px;
        }

        .menu-item-text {
            font-size: 14px;
            font-weight: 500;
        }

        .menu-item-badge {
            margin-left: auto;
            background: var(--primary-color);
            color: white;
            font-size: 11px;
            padding: 2px 8px;
            border-radius: 10px;
            font-weight: 600;
        }

        /* User Profile in Sidebar */
        .sidebar-user {
            padding: 20px;
            border-top: 1px solid var(--border-color);
            margin-top: auto;
            background: rgba(29, 185, 84, 0.05);
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-avatar {
            width: 45px;
            height: 45px;
            background: linear-gradient(135deg, var(--primary-color), #1ed760);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            font-weight: 600;
            color: white;
        }

        .user-details {
            flex: 1;
        }

        .user-name {
            font-size: 14px;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 2px;
        }

        .user-role {
            font-size: 11px;
            color: var(--text-secondary);
        }

        .logout-btn {
            background: none;
            border: none;
            color: var(--text-secondary);
            padding: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            border-radius: 6px;
        }

        .logout-btn:hover {
            background: rgba(255, 59, 48, 0.1);
            color: #ff3b30;
        }

        /* Main Content */
        .main-content {
            margin-left: 260px;
            min-height: 100vh;
            transition: all 0.3s ease;
        }

        /* Top Header */
        .top-header {
            background: var(--card-bg);
            padding: 20px 30px;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 999;
        }

        .header-title {
            font-size: 24px;
            font-weight: 600;
            color: var(--text-primary);
            margin: 0;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .header-btn {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--border-color);
            color: var(--text-primary);
            padding: 8px 16px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 14px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .header-btn:hover {
            background: rgba(255, 255, 255, 0.1);
            color: var(--primary-color);
            border-color: var(--primary-color);
        }

        /* Content Area */
        .content-area {
            padding: 30px;
        }

        /* Mobile Toggle */
        .mobile-toggle {
            display: none;
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 1001;
            background: var(--primary-color);
            border: none;
            color: white;
            width: 45px;
            height: 45px;
            border-radius: 10px;
            font-size: 20px;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(29, 185, 84, 0.3);
        }

        /* Responsive */
        @media (max-width: 992px) {
            .sidebar {
                left: -260px;
            }

            .sidebar.active {
                left: 0;
            }

            .main-content {
                margin-left: 0;
            }

            .mobile-toggle {
                display: block;
            }

            .top-header {
                padding-left: 80px;
            }
        }

        /* Alert Styles */
        .alert {
            border-radius: 10px;
            border: none;
            padding: 15px 20px;
            margin-bottom: 20px;
        }

        .alert-success {
            background: rgba(29, 185, 84, 0.1);
            color: var(--primary-color);
            border: 1px solid rgba(29, 185, 84, 0.3);
        }

        .alert-danger {
            background: rgba(255, 59, 48, 0.1);
            color: #ff3b30;
            border: 1px solid rgba(255, 59, 48, 0.3);
        }

        .alert-info {
            background: rgba(0, 122, 255, 0.1);
            color: #007aff;
            border: 1px solid rgba(0, 122, 255, 0.3);
        }
    </style>

    @stack('styles')
</head>
<body>
    <!-- Mobile Toggle Button -->
    <button class="mobile-toggle" onclick="toggleSidebar()">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <!-- Sidebar Header -->
        <div class="sidebar-header">
            <a href="{{ route('dashboard') }}" class="sidebar-brand">
                <div class="sidebar-brand-icon">
                    <i class="fas fa-music"></i>
                </div>
                <div>
                    <div class="sidebar-brand-text">WaveStream</div>
                    <div class="sidebar-brand-subtitle">Admin Panel</div>
                </div>
            </a>
        </div>

        <!-- Sidebar Menu -->
        <nav class="sidebar-menu">
            <!-- Dashboard Section -->
            <div class="menu-section-title">Main</div>
            <a href="{{ route('dashboard') }}" class="menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="fas fa-tachometer-alt"></i>
                <span class="menu-item-text">Dashboard</span>
            </a>

            <!-- Content Management -->
            <div class="menu-section-title">Content</div>
            <a href="{{ route('admin.music.index') }}" class="menu-item {{ request()->routeIs('admin.music.*') ? 'active' : '' }}">
                <i class="fas fa-music"></i>
                <span class="menu-item-text">Music Library</span>
            </a>
            <a href="{{ route('songs.index') }}" class="menu-item {{ request()->routeIs('songs.*') && !request()->routeIs('admin.*') ? 'active' : '' }}">
                <i class="fas fa-compact-disc"></i>
                <span class="menu-item-text">Songs</span>
            </a>
            <a href="{{ route('playlists.index') }}" class="menu-item {{ request()->routeIs('playlists.*') ? 'active' : '' }}">
                <i class="fas fa-list-ul"></i>
                <span class="menu-item-text">Playlists</span>
            </a>

            <!-- User Management -->
            <div class="menu-section-title">Management</div>
            <a href="{{ route('admin.users.index') }}" class="menu-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                <i class="fas fa-users"></i>
                <span class="menu-item-text">Users</span>
            </a>
            <a href="{{ route('admin.feedback.index') }}" class="menu-item {{ request()->routeIs('admin.feedback.*') ? 'active' : '' }}">
                <i class="fas fa-comments"></i>
                <span class="menu-item-text">Feedback</span>
            </a>

            <!-- Settings -->
            <div class="menu-section-title">System</div>
            <a href="{{ route('home') }}" class="menu-item" target="_blank">
                <i class="fas fa-globe"></i>
                <span class="menu-item-text">View Website</span>
                <i class="fas fa-external-link-alt ms-auto" style="font-size: 12px;"></i>
            </a>
        </nav>

        <!-- User Profile -->
        <div class="sidebar-user">
            <div class="user-info">
                <div class="user-avatar">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <div class="user-details">
                    <div class="user-name">{{ auth()->user()->name }}</div>
                    <div class="user-role">Administrator</div>
                </div>
                <form method="POST" action="{{ route('admin.logout') }}" class="d-inline">
                    @csrf
                    <button type="submit" class="logout-btn" title="Logout">
                        <i class="fas fa-sign-out-alt"></i>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Content Area -->
        <div class="content-area" style="padding-top: 30px;">
            <!-- Alerts -->
            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                </div>
            @endif

            @if(session('info'))
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>{{ session('info') }}
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('active');
        }

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            const sidebar = document.getElementById('sidebar');
            const toggle = document.querySelector('.mobile-toggle');
            
            if (window.innerWidth <= 992) {
                if (!sidebar.contains(event.target) && !toggle.contains(event.target)) {
                    sidebar.classList.remove('active');
                }
            }
        });
    </script>

    @stack('scripts')
</body>
</html>
