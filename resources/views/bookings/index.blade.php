@extends('layouts.app')

@section('title', 'Booking Layanan Puskesmas - Sehatin')

@section('content')
<div class="container my-5">
    <h2 class="fw-bold mb-4">
        <i class="bi bi-calendar-check" style="color: var(--primary);"></i> Booking Layanan Puskesmas
    </h2>

    <div class="row g-4">
        @forelse($services as $service)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h6 class="card-title fw-bold">{{ $service->name }}</h6>
                        <small class="text-muted d-block mb-2">
                            <i class="bi bi-hospital"></i> {{ $service->healthCenter->name }}
                        </small>
                        <small class="text-muted d-block mb-2">
                            <i class="bi bi-geo-alt"></i> {{ $service->healthCenter->city }}
                        </small>
                        
                        <p class="small mb-3">{{ $service->description }}</p>

                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <p class="mb-0 fw-bold" style="color: var(--primary); font-size: 1.25rem;">
                                    Rp {{ number_format($service->price, 0, ',', '.') }}
                                </p>
                                <small class="text-muted">{{ $service->estimated_duration }} menit</small>
                            </div>
                            <div>
                                <span class="badge bg-info">{{ $service->quota_per_day }} kuota/hari</span>
                            </div>
                        </div>

                        <a href="{{ route('bookings.create', $service) }}" class="btn btn-primary btn-sm w-100">
                            <i class="bi bi-calendar-check"></i> Pesan Sekarang
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">
                    <i class="bi bi-info-circle"></i> Tidak ada layanan yang tersedia saat ini
                </div>
            </div>
        @endforelse
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $services->links() }}
    </div>

    <!-- Side Info -->
    <div class="row mt-5">
        <div class="col-md-6 offset-md-3">
            <div class="card bg-light border-0">
                <div class="card-body text-center">
                    <h5 class="card-title fw-bold mb-3">Cara Booking</h5>
                    <ol class="text-start">
                        <li class="mb-2">Pilih layanan kesehatan yang Anda inginkan</li>
                        <li class="mb-2">Isi tanggal dan waktu yang diinginkan</li>
                        <li class="mb-2">Konfirmasi booking Anda</li>
                        <li>Tunggu konfirmasi dari puskesmas</li>
                    </ol>
                    <hr>
                    <p class="text-muted small mb-0">Anda dapat membatalkan booking hingga 24 jam sebelum jadwal</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
