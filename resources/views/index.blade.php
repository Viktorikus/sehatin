@extends('layouts.app')

@section('title', 'Beranda - Sehatin')

@section('content')
<div class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold mb-4">Selamat Datang di Sehatin</h1>
                <p class="lead mb-4">Platform kesehatan masyarakat yang memudahkan Anda menjaga kesehatan, booking puskesmas, dan melaporkan masalah kesehatan lingkungan.</p>
                @guest
                    <a href="{{ route('register') }}" class="btn btn-light btn-lg me-2">Daftar Sekarang</a>
                    <a href="{{ route('login') }}" class="btn btn-outline-light btn-lg">Login</a>
                @else
                    <a href="{{ route('dashboard') }}" class="btn btn-light btn-lg">Ke Dashboard</a>
                @endguest
            </div>
            <div class="col-lg-6">
                <svg fill="white" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="opacity: 0.3;">
                    <path d="M19 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z"/>
                </svg>
            </div>
        </div>
    </div>
</div>

<div class="container my-5">
    <h2 class="text-center mb-5 fw-bold">Fitur Utama Sehatin</h2>
    
    <div class="row g-4">
        <!-- Booking Puskesmas -->
        <div class="col-md-6 col-lg-4">
            <div class="card h-100 text-center">
                <div class="card-body p-4">
                    <div style="width: 60px; height: 60px; background: #e6f2ff; border-radius: 50%; margin: 0 auto 1rem; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-calendar-check" style="font-size: 2rem; color: var(--primary);"></i>
                    </div>
                    <h5 class="card-title fw-bold">Booking Puskesmas</h5>
                    <p class="card-text">Pesan layanan kesehatan di puskesmas terdekat dengan mudah tanpa antri panjang.</p>
                    @auth
                        <a href="{{ route('bookings.index') }}" class="btn btn-primary btn-sm">Mulai Booking</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-primary btn-sm">Login untuk Booking</a>
                    @endauth
                </div>
            </div>
        </div>

        <!-- Monitoring Penyakit -->
        <div class="col-md-6 col-lg-4">
            <div class="card h-100 text-center">
                <div class="card-body p-4">
                    <div style="width: 60px; height: 60px; background: #fff3cd; border-radius: 50%; margin: 0 auto 1rem; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-virus" style="font-size: 2rem; color: #ff9800;"></i>
                    </div>
                    <h5 class="card-title fw-bold">Monitoring Penyakit</h5>
                    <p class="card-text">Laporkan gejala penyakit dan bantu pemerintah memantau kesehatan masyarakat.</p>
                    @auth
                        <a href="{{ route('disease.index') }}" class="btn btn-primary btn-sm">Lihat Laporan</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-primary btn-sm">Login</a>
                    @endauth
                </div>
            </div>
        </div>

        <!-- Laporan Lingkungan -->
        <div class="col-md-6 col-lg-4">
            <div class="card h-100 text-center">
                <div class="card-body p-4">
                    <div style="width: 60px; height: 60px; background: #e8f5e9; border-radius: 50%; margin: 0 auto 1rem; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-tree" style="font-size: 2rem; color: #4caf50;"></i>
                    </div>
                    <h5 class="card-title fw-bold">Kesehatan Lingkungan</h5>
                    <p class="card-text">Laporkan masalah lingkungan yang berdampak pada kesehatan masyarakat.</p>
                    @auth
                        <a href="{{ route('environmental.index') }}" class="btn btn-primary btn-sm">Lihat Laporan</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-primary btn-sm">Login</a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>

<div class="bg-light py-5">
    <div class="container">
        <h2 class="text-center mb-5 fw-bold">Mengapa Memilih Sehatin?</h2>
        
        <div class="row g-4">
            <div class="col-md-6">
                <div class="d-flex mb-3">
                    <div style="width: 40px; height: 40px; background: var(--primary); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 1rem; flex-shrink: 0;">
                        <i class="bi bi-check text-white fw-bold"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold">Mudah Digunakan</h5>
                        <p class="text-muted">Interface yang sederhana dan intuitif untuk semua kalangan.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="d-flex mb-3">
                    <div style="width: 40px; height: 40px; background: var(--primary); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 1rem; flex-shrink: 0;">
                        <i class="bi bi-check text-white fw-bold"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold">Aman & Terpercaya</h5>
                        <p class="text-muted">Data Anda dilindungi dengan enkripsi terkini.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="d-flex mb-3">
                    <div style="width: 40px; height: 40px; background: var(--primary); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 1rem; flex-shrink: 0;">
                        <i class="bi bi-check text-white fw-bold"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold">24/7 Tersedia</h5>
                        <p class="text-muted">Akses aplikasi kapan saja, di mana saja.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="d-flex mb-3">
                    <div style="width: 40px; height: 40px; background: var(--primary); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 1rem; flex-shrink: 0;">
                        <i class="bi bi-check text-white fw-bold"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold">Gratis</h5>
                        <p class="text-muted">Layanan dasar gratis untuk semua pengguna.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
