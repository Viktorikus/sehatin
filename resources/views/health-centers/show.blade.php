@extends('layouts.app')

@section('title', $healthCenter->name . ' - Sehatin')

@section('content')
<div class="container my-5">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-lg-8">
            <h1 class="fw-bold">{{ $healthCenter->name }}</h1>
            <p class="text-muted">
                <i class="bi bi-geo-alt"></i> {{ $healthCenter->address }}, {{ $healthCenter->city }}
            </p>
        </div>
        <div class="col-lg-4">
            @auth
                <a href="{{ route('bookings.index') }}" class="btn btn-primary w-100">
                    <i class="bi bi-calendar-check"></i> Booking Sekarang
                </a>
            @else
                <a href="{{ route('login') }}" class="btn btn-primary w-100">
                    <i class="bi bi-box-arrow-in-right"></i> Login untuk Booking
                </a>
            @endauth
        </div>
    </div>

    <div class="row g-4 mb-4">
        <!-- Info Card -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fw-bold">Informasi Kontak</h5>
                    <hr>
                    <p class="small mb-2">
                        <strong><i class="bi bi-telephone"></i> Telepon:</strong><br>
                        {{ $healthCenter->phone }}
                    </p>
                    <p class="small mb-2">
                        <strong><i class="bi bi-envelope"></i> Email:</strong><br>
                        {{ $healthCenter->email }}
                    </p>
                    <p class="small mb-2">
                        <strong><i class="bi bi-clock"></i> Jam Operasional:</strong><br>
                        {{ $healthCenter->operating_hours ?? 'Senin - Jumat: 08:00 - 16:00' }}
                    </p>
                    <p class="small">
                        <strong><i class="bi bi-map"></i> Status:</strong><br>
                        <span class="badge bg-success">Aktif</span>
                    </p>
                </div>
            </div>
        </div>

        <!-- Services -->
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header bg-white border-bottom">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-stethoscope"></i> Layanan Kesehatan
                    </h5>
                </div>
                <div class="card-body">
                    @forelse($services as $service)
                        <div class="d-flex justify-content-between align-items-start mb-3 pb-3 border-bottom">
                            <div class="flex-grow-1">
                                <h6 class="fw-bold">{{ $service->name }}</h6>
                                <small class="text-muted d-block">{{ $service->description }}</small>
                                <small class="text-muted d-block">
                                    <i class="bi bi-hourglass-split"></i> ~{{ $service->estimated_duration }} menit
                                </small>
                            </div>
                            <div class="text-end">
                                <p class="fw-bold mb-2" style="color: var(--primary);">Rp {{ number_format($service->price, 0, ',', '.') }}</p>
                                @auth
                                    <a href="{{ route('bookings.create', $service) }}" class="btn btn-sm btn-primary">
                                        <i class="bi bi-calendar-check"></i> Booking
                                    </a>
                                @else
                                    <a href="{{ route('login') }}" class="btn btn-sm btn-primary">
                                        <i class="bi bi-box-arrow-in-right"></i> Login
                                    </a>
                                @endauth
                            </div>
                        </div>
                    @empty
                        <p class="text-muted text-center">Belum ada layanan tersedia</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- Health Workers -->
    <div class="card mb-4">
        <div class="card-header bg-white border-bottom">
            <h5 class="card-title mb-0">
                <i class="bi bi-people"></i> Tenaga Kesehatan
            </h5>
        </div>
        <div class="card-body">
            <div class="row g-3">
                @forelse($workers as $worker)
                    <div class="col-md-6">
                        <div class="d-flex">
                            <div style="width: 50px; height: 50px; background: var(--primary); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; margin-right: 1rem; flex-shrink: 0;">
                                <i class="bi bi-person-fill"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold">{{ $worker->user->name }}</h6>
                                <small class="text-muted">{{ ucfirst($worker->position) }}</small>
                                @if($worker->specialization)
                                    <br><small class="text-muted">Spesialisasi: {{ $worker->specialization }}</small>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <p class="text-muted text-center">Belum ada data tenaga kesehatan</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Description -->
    @if($healthCenter->description)
        <div class="card">
            <div class="card-header bg-white border-bottom">
                <h5 class="card-title mb-0">Tentang Puskesmas</h5>
            </div>
            <div class="card-body">
                {{ $healthCenter->description }}
            </div>
        </div>
    @endif
</div>
@endsection
