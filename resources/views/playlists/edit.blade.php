@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Edit Playlist</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('playlists.update', $playlist) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name" class="form-label">Playlist Name</label>
                            <input type="text" class="form-control bg-dark text-white @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name', $playlist->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description (Optional)</label>
                            <textarea class="form-control bg-dark text-white @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="3">{{ old('description', $playlist->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('playlists.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Back
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Update Playlist
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .card {
        background-color: #181818;
        border: none;
    }

    .card-header {
        background-color: #000000;
        border-bottom: 1px solid #333;
    }

    .form-control {
        border: 1px solid #333;
    }

    .form-control:focus {
        background-color: #181818;
        border-color: #1DB954;
        box-shadow: 0 0 0 0.25rem rgba(29, 185, 84, 0.25);
    }
</style>
@endpush
@endsection 