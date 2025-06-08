@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card bg-dark text-white border-0 shadow-lg">
                <div class="card-body p-4">
                    <h2 class="mb-4">Upload New Song</h2>

                    <form action="{{ route('songs.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="title" class="form-label">Song Title</label>
                            <input type="text" class="form-control bg-dark text-white border-secondary @error('title') is-invalid @enderror"
                                id="title" name="title" value="{{ old('title') }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="artist" class="form-label">Artist</label>
                            <input type="text" class="form-control bg-dark text-white border-secondary @error('artist') is-invalid @enderror"
                                id="artist" name="artist" value="{{ old('artist') }}" required>
                            @error('artist')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- <div class="mb-3">
                            <label for="category_id" class="form-label">Category</label>
                            <select class="form-select bg-dark text-white border-secondary @error('category_id') is-invalid @enderror"
                                id="category_id" name="category_id" required>
                                <option value="">Select a category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div> --}}

                        <div class="mb-3">
                            <label for="audio_file" class="form-label">Audio File (MP3/WAV)</label>
                            <input type="file" class="form-control bg-dark text-white border-secondary @error('audio_file') is-invalid @enderror"
                                id="audio_file" name="audio_file" accept=".mp3,.wav" required>
                            @error('audio_file')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Maximum file size: 10MB</small>
                        </div>

                        <div class="mb-4">
                            <label for="cover_image" class="form-label">Cover Image (Optional)</label>
                            <input type="file" class="form-control bg-dark text-white border-secondary @error('cover_image') is-invalid @enderror"
                                id="cover_image" name="cover_image" accept="image/*">
                            @error('cover_image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Maximum file size: 2MB</small>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('songs.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Back
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-upload me-2"></i>Upload Song
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .form-control:focus, .form-select:focus {
        background-color: #1a1a1a;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.25rem rgba(var(--primary-rgb), 0.25);
        color: white;
    }

    .form-control::file-selector-button {
        background-color: var(--primary-color);
        color: white;
        border: none;
        padding: 0.375rem 0.75rem;
        border-radius: 0.25rem;
    }

    .form-control::file-selector-button:hover {
        background-color: var(--primary-hover);
    }
</style>
@endsection