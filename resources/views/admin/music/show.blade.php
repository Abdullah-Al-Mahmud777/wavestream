@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Music Details</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.music.edit', $music->id) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="text-center mb-4">
                                @if($music->cover_image)
                                    <img src="{{ Storage::url($music->cover_image) }}" alt="Cover Image" 
                                         class="img-fluid rounded" style="max-height: 300px;">
                                @else
                                    <img src="{{ asset('images/default-cover.jpg') }}" alt="Default Cover" 
                                         class="img-fluid rounded" style="max-height: 300px;">
                                @endif
                            </div>
                        </div>
                        <div class="col-md-8">
                            <table class="table table-bordered">
                                <tr>
                                    <th style="width: 200px;">Title</th>
                                    <td>{{ $music->title }}</td>
                                </tr>
                                <tr>
                                    <th>Artist</th>
                                    <td>{{ $music->artist }}</td>
                                </tr>
                                <tr>
                                    <th>Album</th>
                                    <td>{{ $music->album ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Genre</th>
                                    <td>{{ $music->genre }}</td>
                                </tr>
                                <tr>
                                    <th>File</th>
                                    <td>
                                        <audio controls>
                                            <source src="{{ Storage::url($music->file_path) }}" type="audio/mpeg">
                                            Your browser does not support the audio element.
                                        </audio>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Created At</th>
                                    <td>{{ $music->created_at->format('F j, Y g:i A') }}</td>
                                </tr>
                                <tr>
                                    <th>Last Updated</th>
                                    <td>{{ $music->updated_at->format('F j, Y g:i A') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('admin.music.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back to List
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 