@extends('layouts.app')

@section('title', 'Daftar Puskesmas - Sehatin')

@section('content')
<div class="container my-5">
    <div class="row mb-4">
        <div class="col-md-8">
            <h2 class="fw-bold">Cari Puskesmas Terdekat</h2>
            <p class="text-muted">Temukan layanan kesehatan berkualitas di puskesmas terpercaya</p>
        </div>
        <div class="col-md-4">
            <a href="{{ route('health-centers.map') }}" class="btn btn-primary">
                <i class="bi bi-map"></i> Lihat Peta
            </a>
        </div>
    </div>

    <form action="{{ route('health-centers.search') }}" method="GET" class="mb-4">
        <div class="row g-2">
            <div class="col-md-6">
                <input type="text" name="name" class="form-control" placeholder="Cari nama puskesmas..." value="{{ request('name') }}">
            </div>
            <div class="col-md-4">
                <input type="text" name="city" class="form-control" placeholder="Kota..." value="{{ request('city') }}">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="bi bi-search"></i> Cari
                </button>
            </div>
        </div>
    </form>

    <div class="row g-4">
        @forelse($healthCenters as $center)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">{{ $center->name }}</h5>
                        <small class="text-muted d-block mb-2">
                            <i class="bi bi-geo-alt"></i> {{ $center->address }}
                        </small>
                        <small class="text-muted d-block mb-2">
                            <i class="bi bi-telephone"></i> {{ $center->phone }}
                        </small>
                        <small class="text-muted d-block mb-3">
                            <i class="bi bi-clock"></i> {{ $center->operating_hours ?? 'Buka 08:00 - 16:00' }}
                        </small>
                        
                        <p class="small mb-3">
                            <strong>Layanan:</strong> {{ $center->services->count() }} layanan tersedia
                        </p>

                        <a href="{{ route('health-centers.show', $center) }}" class="btn btn-primary btn-sm w-100">
                            <i class="bi bi-eye"></i> Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">
                    <i class="bi bi-info-circle"></i> Tidak ada puskesmas yang ditemukan
                </div>
            </div>
        @endforelse
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $healthCenters->links() }}
    </div>
</div>
@endsection
