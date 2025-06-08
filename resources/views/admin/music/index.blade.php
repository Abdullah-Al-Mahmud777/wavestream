@extends('layouts.admin')

@section('title', 'Manage Music')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Music List</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.music.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Add New Music
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Cover</th>
                                <th>Title</th>
                                <th>Artist</th>
                                <th>Album</th>
                                <th>Genre</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($musics as $music)
                                <tr>
                                    <td>{{ $music->id }}</td>
                                    <td>
                                        @if($music->cover_image)
                                            <img src="{{ Storage::url($music->cover_image) }}" alt="Cover" style="width: 50px; height: 50px; object-fit: cover;">
                                        @else
                                            <img src="{{ asset('images/default-cover.jpg') }}" alt="Default Cover" style="width: 50px; height: 50px; object-fit: cover;">
                                        @endif
                                    </td>
                                    <td>{{ $music->title }}</td>
                                    <td>{{ $music->artist }}</td>
                                    <td>{{ $music->album ?? 'N/A' }}</td>
                                    <td>{{ $music->genre }}</td>
                                    <td>
                                        <a href="{{ route('admin.music.show', $music->id) }}" class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.music.edit', $music->id) }}" class="btn btn-primary btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.music.destroy', $music->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this music?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                    <div class="mt-4">
                        {{ $musics->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .form-control, .form-select {
        border: 1px solid #333;
    }
    .form-control:focus, .form-select:focus {
        background-color: #181818;
        border-color: #1DB954;
        box-shadow: 0 0 0 0.25rem rgba(29, 185, 84, 0.25);
    }
    .table {
        margin-bottom: 0;
    }
    .pagination {
        margin-bottom: 0;
    }
</style>
@endpush
@endsection 