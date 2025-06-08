@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <div class="error-content">
                <h1 class="display-1 fw-bold text-primary mb-4">404</h1>
                <h2 class="mb-4">Oops! Page Not Found</h2>
                <p class="lead mb-5">The page you're looking for doesn't exist or has been moved.</p>
                
                <div class="d-flex justify-content-center gap-3">
                    <a href="{{ url('/') }}" class="btn btn-primary">
                        <i class="fas fa-home me-2"></i>Go Home
                    </a>
                    <a href="javascript:history.back()" class="btn btn-outline-primary">
                        <i class="fas fa-arrow-left me-2"></i>Go Back
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .error-content {
        padding: 3rem;
        background: rgba(0, 0, 0, 0.5);
        border-radius: 1rem;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
        backdrop-filter: blur(10px);
        animation: fadeIn 0.5s ease-in-out;
    }

    .error-content h1 {
        font-size: 8rem;
        background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
    }

    .error-content h2 {
        color: var(--text-color);
        font-size: 2.5rem;
        margin-bottom: 1rem;
    }

    .error-content p {
        color: var(--text-color);
        opacity: 0.8;
        font-size: 1.2rem;
    }

    .btn {
        padding: 0.8rem 2rem;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .btn-primary {
        background: var(--primary-color);
        border: none;
    }

    .btn-primary:hover {
        background: var(--primary-hover);
        transform: translateY(-2px);
    }

    .btn-outline-primary {
        border-color: var(--primary-color);
        color: var(--primary-color);
    }

    .btn-outline-primary:hover {
        background: var(--primary-color);
        color: white;
        transform: translateY(-2px);
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @media (max-width: 768px) {
        .error-content h1 {
            font-size: 6rem;
        }
        
        .error-content h2 {
            font-size: 2rem;
        }
        
        .error-content p {
            font-size: 1rem;
        }
    }
</style>
@endsection 