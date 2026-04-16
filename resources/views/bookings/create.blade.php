@extends('layouts.app')

@section('title', 'Pesan ' . $service->name . ' - Sehatin')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-calendar-check"></i> Pesan Layanan Kesehatan
                    </h5>
                </div>
                <div class="card-body">
                    <!-- Service Info -->
                    <div class="bg-light p-3 rounded mb-4">
                        <h6 class="fw-bold">{{ $service->name }}</h6>
                        <small class="d-block text-muted mb-2">
                            <i class="bi bi-hospital"></i> {{ $healthCenter->name }}
                        </small>
                        <small class="d-block text-muted mb-2">
                            <i class="bi bi-geo-alt"></i> {{ $healthCenter->address }}
                        </small>
                        <small class="d-block">
                            <i class="bi bi-telephone"></i> {{ $healthCenter->phone }}
                        </small>
                    </div>

                    <form action="{{ route('bookings.store') }}" method="POST">
                        @csrf

                        <input type="hidden" name="health_service_id" value="{{ $service->id }}">

                        <!-- Appointment Date -->
                        <div class="mb-3">
                            <label for="appointment_date" class="form-label fw-bold">
                                Tanggal & Waktu <span class="text-danger">*</span>
                            </label>
                            <input type="datetime-local" class="form-control @error('appointment_date') is-invalid @enderror" 
                                   id="appointment_date" name="appointment_date" 
                                   value="{{ old('appointment_date') }}" required>
                            @error('appointment_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Minimal besok. Jam operasional: {{ $healthCenter->operating_hours }}</small>
                        </div>

                        <!-- Notes -->
                        <div class="mb-3">
                            <label for="notes" class="form-label fw-bold">Catatan Khusus</label>
                            <textarea class="form-control @error('notes') is-invalid @enderror" 
                                      id="notes" name="notes" rows="4" 
                                      placeholder="Contoh: Alergi obat, kondisi khusus, dll">{{ old('notes') }}</textarea>
                            @error('notes')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Opsional. Sampaikan kondisi kesehatan khusus Anda</small>
                        </div>

                        <!-- Package Info -->
                        <div class="bg-light p-3 rounded mb-4">
                            <div class="row">
                                <div class="col-6">
                                    <p class="small text-muted mb-1">Harga Layanan</p>
                                    <p class="fw-bold">Rp {{ number_format($service->price, 0, ',', '.') }}</p>
                                </div>
                                <div class="col-6">
                                    <p class="small text-muted mb-1">Estimasi Durasi</p>
                                    <p class="fw-bold">{{ $service->estimated_duration }} menit</p>
                                </div>
                            </div>
                        </div>

                        <!-- Terms -->
                        <div class="mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="terms" required>
                                <label class="form-check-label" for="terms">
                                    Saya setuju dengan kebijakan booking dan syarat & ketentuan Sehatin
                                </label>
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('bookings.index') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-x-circle"></i> Batal
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle"></i> Konfirmasi Booking
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Info Box -->
            <div class="alert alert-info mt-4" role="alert">
                <h6 class="alert-heading">
                    <i class="bi bi-info-circle"></i> Informasi Penting
                </h6>
                <ul class="mb-0 small">
                    <li>Booking Anda akan dikonfirmasi oleh puskesmas dalam waktu 24 jam</li>
                    <li>Anda akan menerima notifikasi melalui email</li>
                    <li>Pembatalan booking dapat dilakukan hingga 24 jam sebelum jadwal</li>
                    <li>Silakan datang 15 menit sebelum waktu yang dijadwalkan</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
