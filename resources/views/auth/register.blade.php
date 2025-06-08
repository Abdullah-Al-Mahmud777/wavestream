@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card bg-dark text-white border-0 shadow-lg">
                <div class="card-body p-5">
                    <h2 class="text-center mb-4 section-title">Create Account</h2>
                    <p class="text-center text-muted mb-4">Join our music community today!</p>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="name" class="form-label">Full Name</label>
                            <input id="name" type="text" class="form-control bg-dark text-white border-secondary @error('name') is-invalid @enderror" 
                                   name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="email" class="form-label">Email Address</label>
                            <input id="email" type="email" class="form-control bg-dark text-white border-secondary @error('email') is-invalid @enderror" 
                                   name="email" value="{{ old('email') }}" required autocomplete="email">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label">Password</label>
                            <input id="password" type="password" class="form-control bg-dark text-white border-secondary @error('password') is-invalid @enderror" 
                                   name="password" required autocomplete="new-password">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password-confirm" class="form-label">Confirm Password</label>
                            <input id="password-confirm" type="password" class="form-control bg-dark text-white border-secondary" 
                                   name="password_confirmation" required autocomplete="new-password">
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-user-plus me-2"></i>Register
                            </button>
                        </div>

                        <div class="text-center mt-4">
                            <p class="text-muted mb-0">Already have an account?</p>
                            <a class="btn btn-link text-primary" href="{{ route('login') }}">
                                Login here
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
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
    
    .btn-primary {
        background: linear-gradient(45deg, var(--primary-color), #1ed760);
        border: none;
        padding: 0.8rem 2rem;
        border-radius: 50px;
        font-weight: 600;
        letter-spacing: 0.5px;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        box-shadow: 0 4px 15px rgba(29, 185, 84, 0.3);
    }
    
    .btn-primary:hover {
        background: linear-gradient(45deg, #1ed760, var(--primary-color));
        transform: translateY(-3px) scale(1.02);
        box-shadow: 0 8px 25px rgba(29, 185, 84, 0.4);
    }
</style>
@endsection 