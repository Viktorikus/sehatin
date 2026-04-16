@extends('layouts.app')

@section('title', 'Dashboard - Sehatin')

@section('content')
<div class="container my-5">
    <div class="row mb-4">
        <div class="col-md-8">
            <h1 class="fw-bold">Selamat Datang, {{ Auth::user()->name }}!</h1>
            <p class="text-muted">Kelola kesehatan Anda dengan mudah melalui Sehatin</p>
        </div>
        <div class="col-md-4">
            <a href="{{ route('bookings.index') }}" class="btn btn-primary w-100 mb-2">
                <i class="bi bi-calendar-check"></i> Booking Puskesmas
            </a>
            <a href="{{ route('disease.create') }}" class="btn btn-outline-primary w-100 mb-2">
                <i class="bi bi-virus"></i> Laporkan Penyakit
            </a>
            <a href="{{ route('environmental.create') }}" class="btn btn-outline-primary w-100">
                <i class="bi bi-tree"></i> Lapor Lingkungan
            </a>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h6 class="text-muted mb-2">Total Booking</h6>
                    <h2 class="fw-bold" style="color: var(--primary);">{{ $totalBookings }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h6 class="text-muted mb-2">Laporan Penyakit</h6>
                    <h2 class="fw-bold" style="color: #ff9800;">{{ $totalDiseaseReports }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h6 class="text-muted mb-2">Laporan Lingkungan</h6>
                    <h2 class="fw-bold" style="color: #4caf50;">{{ $totalEnvReports }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h6 class="text-muted mb-2">Status Profil</h6>
                    <span class="badge bg-success">Aktif</span>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Upcoming Bookings -->
        <div class="col-lg-6">
            <div class="card mb-4">
                <div class="card-header bg-white border-bottom">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-calendar-check" style="color: var(--primary);"></i> Booking Mendatang
                    </h5>
                </div>
                <div class="card-body">
                    @if($upcomingBookings->isEmpty())
                        <p class="text-muted text-center py-3">Anda belum memiliki booking. <a href="{{ route('bookings.index') }}">Booking sekarang</a></p>
                    @else
                        @foreach($upcomingBookings as $booking)
                            <div class="mb-3 pb-3 border-bottom">
                                <h6 class="fw-bold">{{ $booking->healthService->name }}</h6>
                                <small class="text-muted">
                                    <i class="bi bi-geo-alt"></i> {{ $booking->healthCenter->name }}
                                </small><br>
                                <small class="text-muted">
                                    <i class="bi bi-calendar"></i> {{ $booking->appointment_date->format('d M Y - H:i') }}
                                </small>
                                <div class="mt-2">
                                    <span class="badge bg-success">{{ ucfirst($booking->status) }}</span>
                                </div>
                            </div>
                        @endforeach
                        <a href="{{ route('bookings.my-bookings') }}" class="btn btn-sm btn-outline-primary w-100">Lihat Semua Booking</a>
                    @endif
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="col-lg-6">
            <div class="card mb-4">
                <div class="card-header bg-white border-bottom">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-activity" style="color: var(--primary);"></i> Aktivitas Terbaru
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <h6 class="text-muted mb-2">Laporan Penyakit</h6>
                            @if($recentReports->isEmpty())
                                <p class="text-muted small">Belum ada laporan</p>
                            @else
                                @foreach($recentReports as $report)
                                    <small class="d-block mb-2">
                                        <i class="bi bi-virus"></i> {{ $report->disease_name }}
                                        <br>
                                        <span class="text-muted text-nowrap">{{ $report->created_at->diffForHumans() }}</span>
                                    </small>
                                @endforeach
                            @endif
                        </div>
                        <div class="col-6">
                            <h6 class="text-muted mb-2">Laporan Lingkungan</h6>
                            @if($myEnvironmentalReports->isEmpty())
                                <p class="text-muted small">Belum ada laporan</p>
                            @else
                                @foreach($myEnvironmentalReports as $report)
                                    <small class="d-block mb-2">
                                        <i class="bi bi-tree"></i> {{ $report->title }}
                                        <br>
                                        <span class="text-muted text-nowrap">{{ $report->created_at->diffForHumans() }}</span>
                                    </small>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Links -->
    <div class="card">
        <div class="card-header bg-light border-bottom">
            <h5 class="card-title mb-0">Akses Cepat</h5>
        </div>
        <div class="card-body">
            <div class="row g-2">
                <div class="col-md-3">
                    <a href="{{ route('bookings.index') }}" class="btn btn-outline-primary w-100">
                        <i class="bi bi-calendar-check"></i> Booking
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="{{ route('disease.index') }}" class="btn btn-outline-primary w-100">
                        <i class="bi bi-virus"></i> Penyakit
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="{{ route('environmental.index') }}" class="btn btn-outline-primary w-100">
                        <i class="bi bi-tree"></i> Lingkungan
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="{{ route('health-centers.index') }}" class="btn btn-outline-primary w-100">
                        <i class="bi bi-hospital"></i> Puskesmas
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
