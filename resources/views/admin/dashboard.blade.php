@extends('layouts.admin')

@section('page-title', 'Dashboard Overview')

@section('content')
<div class="container-fluid">
    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card bg-dark text-white border-0 shadow-lg h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase text-muted mb-2">Total Songs</h6>
                            <h2 class="mb-0">{{ $stats['total_songs'] }}</h2>
                        </div>
                        <div class="icon-circle bg-primary">
                            <i class="fas fa-music text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card bg-dark text-white border-0 shadow-lg h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase text-muted mb-2">Total Users</h6>
                            <h2 class="mb-0">{{ $stats['total_users'] }}</h2>
                        </div>
                        <div class="icon-circle bg-success">
                            <i class="fas fa-users text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card bg-dark text-white border-0 shadow-lg h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase text-muted mb-2">Total Playlists</h6>
                            <h2 class="mb-0">{{ $stats['total_playlists'] }}</h2>
                        </div>
                        <div class="icon-circle bg-info">
                            <i class="fas fa-list text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card bg-dark text-white border-0 shadow-lg h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase text-muted mb-2">Categories</h6>
                            <h2 class="mb-0">{{ $stats['total_categories'] }}</h2>
                        </div>
                        <div class="icon-circle bg-warning">
                            <i class="fas fa-tags text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activities -->
    <div class="row">
        <!-- Recent Songs -->
        <div class="col-xl-6 mb-4">
            <div class="card bg-dark text-white border-0 shadow-lg h-100">
                <div class="card-header bg-transparent border-0">
                    <h5 class="mb-0">Recent Songs</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-dark table-hover">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Artist</th>
                                    <th>Category</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($stats['recent_songs'] as $song)
                                <tr>
                                    <td>{{ $song->title }}</td>
                                    <td>{{ $song->artist }}</td>
                                    <td>
                                        @if($song->category)
                                            {{ $song->category->name }}
                                        @else
                                            No category available
                                        @endif
                                    </td>
                                    <td>{{ $song->created_at->format('M d, Y') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Users -->
        <div class="col-xl-6 mb-4">
            <div class="card bg-dark text-white border-0 shadow-lg h-100">
                <div class="card-header bg-transparent border-0">
                    <h5 class="mb-0">Recent Users</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-dark table-hover">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Joined</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($stats['recent_users'] as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->created_at->format('M d, Y') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .card {
        background: #1e1e1e;
        border: 1px solid #282828;
        border-radius: 12px;
        transition: all 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    }

    .icon-circle {
        width: 55px;
        height: 55px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
    }

    .bg-primary {
        background: linear-gradient(135deg, #1db954, #1ed760) !important;
    }

    .bg-success {
        background: linear-gradient(135deg, #00d4ff, #0099ff) !important;
    }

    .bg-info {
        background: linear-gradient(135deg, #a855f7, #ec4899) !important;
    }

    .bg-warning {
        background: linear-gradient(135deg, #f59e0b, #ef4444) !important;
    }

    .text-muted {
        color: #b3b3b3 !important;
        font-size: 12px;
        font-weight: 500;
        letter-spacing: 0.5px;
    }

    .card-header {
        background: rgba(29, 185, 84, 0.05);
        border-bottom: 1px solid #282828;
        padding: 15px 20px;
    }

    .card-header h5 {
        font-size: 16px;
        font-weight: 600;
        margin: 0;
    }

    .table {
        margin-bottom: 0;
        color: #ffffff;
    }

    .table th {
        border-top: none;
        border-bottom: 1px solid #282828;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 11px;
        letter-spacing: 0.5px;
        color: #b3b3b3;
        padding: 12px 15px;
    }

    .table td {
        vertical-align: middle;
        border-bottom: 1px solid #282828;
        padding: 12px 15px;
        font-size: 14px;
    }

    .table-hover tbody tr:hover {
        background-color: rgba(29, 185, 84, 0.05);
    }

    .table-dark {
        --bs-table-bg: transparent;
    }

    h2 {
        font-size: 32px;
        font-weight: 700;
    }
</style>
@endsection 