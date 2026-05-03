@extends('layouts.admin')

@section('page-title', 'Feedback Management')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card bg-dark border-0 shadow-sm">
                <div class="card-header bg-transparent border-0">
                    <h5 class="mb-0">User Feedback</h5>
                </div>
                <div class="card-body">
                    @if($feedback->isEmpty())
                        <div class="text-center py-5">
                            <i class="fas fa-comments fa-3x text-muted mb-3"></i>
                            <p class="text-muted">No feedback received yet.</p>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-dark table-hover">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Message</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($feedback as $item)
                                    <tr>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ Str::limit($item->message, 50) }}</td>
                                        <td>
                                            <span class="badge 
                                                @if($item->status == 'pending') bg-warning
                                                @elseif($item->status == 'read') bg-info
                                                @else bg-success
                                                @endif">
                                                {{ ucfirst($item->status ?? 'pending') }}
                                            </span>
                                        </td>
                                        <td>{{ $item->created_at->format('M d, Y') }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{ route('admin.feedback.show', $item) }}" class="btn btn-sm btn-info">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <form action="{{ route('admin.feedback.destroy', $item) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-3">
                            {{ $feedback->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .table {
        margin-bottom: 0;
    }
    .badge {
        font-size: 0.85em;
        padding: 0.35em 0.65em;
    }
</style>
@endpush
@endsection
