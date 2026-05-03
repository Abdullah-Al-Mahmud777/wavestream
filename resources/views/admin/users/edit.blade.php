@extends('layouts.admin')

@section('page-title', 'Edit User')

@section('content')
<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card" style="background: #1e1e1e; border: 1px solid #282828; border-radius: 15px;">
            <div class="card-body p-4">
                <h4 class="mb-4" style="color: #1db954;">
                    <i class="fas fa-user-edit me-2"></i>Edit User
                </h4>

                <form action="{{ route('admin.users.update', $user) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label" style="color: #b3b3b3;">Full Name</label>
                        <input type="text" 
                               class="form-control @error('name') is-invalid @enderror" 
                               id="name" 
                               name="name" 
                               value="{{ old('name', $user->name) }}" 
                               required
                               style="background: rgba(0,0,0,0.4); border: 1px solid #282828; color: #fff;">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label" style="color: #b3b3b3;">Email Address</label>
                        <input type="email" 
                               class="form-control @error('email') is-invalid @enderror" 
                               id="email" 
                               name="email" 
                               value="{{ old('email', $user->email) }}" 
                               required
                               style="background: rgba(0,0,0,0.4); border: 1px solid #282828; color: #fff;">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label" style="color: #b3b3b3;">Password (Leave blank to keep current)</label>
                        <input type="password" 
                               class="form-control @error('password') is-invalid @enderror" 
                               id="password" 
                               name="password"
                               style="background: rgba(0,0,0,0.4); border: 1px solid #282828; color: #fff;">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label" style="color: #b3b3b3;">Confirm Password</label>
                        <input type="password" 
                               class="form-control" 
                               id="password_confirmation" 
                               name="password_confirmation"
                               style="background: rgba(0,0,0,0.4); border: 1px solid #282828; color: #fff;">
                    </div>

                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" 
                                   type="checkbox" 
                                   id="is_admin" 
                                   name="is_admin" 
                                   value="1"
                                   {{ old('is_admin', $user->is_admin) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_admin" style="color: #b3b3b3;">
                                Admin User
                            </label>
                        </div>
                    </div>

                    <div class="mb-4">
                        <div class="form-check">
                            <input class="form-check-input" 
                                   type="checkbox" 
                                   id="is_active" 
                                   name="is_active" 
                                   value="1"
                                   {{ old('is_active', $user->is_active) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active" style="color: #b3b3b3;">
                                Active User
                            </label>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Back
                        </a>
                        <button type="submit" class="btn" style="background: linear-gradient(135deg, #1db954, #1ed760); color: white; border: none;">
                            <i class="fas fa-save me-2"></i>Update User
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .form-control:focus {
        background: rgba(0,0,0,0.6);
        border-color: #1db954;
        box-shadow: 0 0 0 3px rgba(29, 185, 84, 0.1);
        color: #fff;
    }

    .form-check-input:checked {
        background-color: #1db954;
        border-color: #1db954;
    }

    .form-check-input:focus {
        box-shadow: 0 0 0 3px rgba(29, 185, 84, 0.1);
    }
</style>
@endsection
