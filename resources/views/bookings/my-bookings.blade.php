@extends('layouts.app')

@section('title', 'Booking Saya - Sehatin')

@section('content')
<div class="container my-5">
    <h2 class="fw-bold mb-4">
        <i class="bi bi-calendar-check" style="color: var(--primary);"></i> Booking Saya
    </h2>

    @forelse($bookings as $booking)
        <div class="card mb-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <h6 class="card-title fw-bold">{{ $booking->healthService->name }}</h6>
                        <small class="text-muted d-block mb-2">
                            <i class="bi bi-hospital"></i> {{ $booking->healthCenter->name }}
                        </small>
                        <small class="text-muted d-block mb-2">
                            <i class="bi bi-calendar"></i> {{ $booking->appointment_date->format('d F Y - H:i') }}
                        </small>
                        @if($booking->queue_number)
                            <small class="d-block">
                                <strong>Antrian:</strong> {{ $booking->queue_number }}
                            </small>
                        @endif
                    </div>
                    <div class="col-md-4 text-end">
                        <div class="mb-3">
                            @if($booking->status === 'pending')
                                <span class="badge bg-warning">Menunggu Konfirmasi</span>
                            @elseif($booking->status === 'confirmed')
                                <span class="badge bg-success">Dikonfirmasi</span>
                            @elseif($booking->status === 'completed')
                                <span class="badge bg-info">Selesai</span>
                            @elseif($booking->status === 'cancelled')
                                <span class="badge bg-danger">Dibatalkan</span>
                            @endif
                        </div>
                        <div>
                            <p class="fw-bold mb-1">Rp {{ number_format($booking->healthService->price, 0, ',', '.') }}</p>
                            <small class="text-muted">{{ $booking->healthService->estimated_duration }} menit</small>
                        </div>
                    </div>
                </div>

                @if($booking->notes)
                    <hr class="my-2">
                    <small class="text-muted">
                        <strong>Catatan:</strong> {{ $booking->notes }}
                    </small>
                @endif

                @if($booking->doctor_notes)
                    <hr class="my-2">
                    <small class="text-muted">
                        <strong>Catatan Dokter:</strong> {{ $booking->doctor_notes }}
                    </small>
                @endif

                <hr class="my-3">
                <div class="d-flex gap-2">
                    <a href="{{ route('bookings.show', $booking) }}" class="btn btn-sm btn-outline-primary">
                        <i class="bi bi-eye"></i> Detail
                    </a>
                    @if(in_array($booking->status, ['pending', 'confirmed']) && $booking->appointment_date > now()->addDay())
                        <form action="{{ route('bookings.cancel', $booking) }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-danger" 
                                    onclick="return confirm('Yakin ingin membatalkan booking ini?')">
                                <i class="bi bi-x-circle"></i> Batalkan
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    @empty
        <div class="alert alert-info text-center">
            <i class="bi bi-info-circle"></i> Anda belum memiliki booking. <a href="{{ route('bookings.index') }}">Buat booking sekarang</a>
        </div>
    @endforelse

    <div class="d-flex justify-content-center mt-4">
        {{ $bookings->links() }}
    </div>
</div>
@endsection
