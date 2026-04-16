@extends('layouts.app')

@section('title', 'Login - Sehatin')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow">
                <div class="card-body p-5">
                    <h3 class="card-title fw-bold text-center mb-4">
                        <i class="bi bi-box-arrow-in-right" style="color: var(--primary);"></i> Login
                    </h3>

                    <form action="{{ route('login') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label fw-bold">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                   id="email" name="email" value="{{ old('email') }}" required autofocus>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label fw-bold">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                   id="password" name="password" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="remember" name="remember">
                            <label class="form-check-label" for="remember">
                                Ingat saya
                            </label>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 mb-3">
                            <i class="bi bi-box-arrow-in-right"></i> Login
                        </button>
                    </form>

                    <hr>

                    <p class="text-center text-muted mb-0">
                        Belum memiliki akun? 
                        <a href="{{ route('register') }}" class="fw-bold">Daftar sekarang</a>
                    </p>
                </div>
            </div>

            <div class="alert alert-info mt-4" role="alert">
                <h6 class="alert-heading">Demo Akun</h6>
                Email: user@example.com<br>
                Password: password
            </div>
        </div>
    </div>
</div>
@endsection
