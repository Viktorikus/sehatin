@extends('layouts.app')

@section('title', 'Laporan Kesehatan Lingkungan - Sehatin')

@section('content')
<div class="container my-5">
    <div class="row mb-4">
        <div class="col-md-8">
            <h2 class="fw-bold">
                <i class="bi bi-tree" style="color: #4caf50;"></i> Kesehatan Lingkungan
            </h2>
            <p class="text-muted">Laporkan masalah lingkungan yang berdampak pada kesehatan masyarakat</p>
        </div>
        <div class="col-md-4">
            @auth
                <a href="{{ route('environmental.create') }}" class="btn btn-primary w-100 mb-2">
                    <i class="bi bi-plus-circle"></i> Buat Laporan
                </a>
            @else
                <a href="{{ route('login') }}" class="btn btn-primary w-100 mb-2">
                    <i class="bi bi-box-arrow-in-right"></i> Login untuk Lapor
                </a>
            @endauth
            <a href="{{ route('environmental.dashboard') }}" class="btn btn-outline-primary w-100">
                <i class="bi bi-graph-up"></i> Dashboard
            </a>
        </div>
    </div>

    <!-- Filter -->
    <form action="{{ route('environmental.index') }}" method="GET" class="mb-4">
        <div class="row g-2">
            <div class="col-md-3">
                <select name="category" class="form-select form-select-sm">
                    <option value="">-- Semua Kategori --</option>
                    <option value="air" {{ request('category') === 'air' ? 'selected' : '' }}>Air</option>
                    <option value="sanitasi" {{ request('category') === 'sanitasi' ? 'selected' : '' }}>Sanitasi</option>
                    <option value="sampah" {{ request('category') === 'sampah' ? 'selected' : '' }}>Sampah</option>
                    <option value="polusi" {{ request('category') === 'polusi' ? 'selected' : '' }}>Polusi</option>
                    <option value="lainnya" {{ request('category') === 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                </select>
            </div>
            <div class="col-md-3">
                <select name="severity" class="form-select form-select-sm">
                    <option value="">-- Semua Tingkat --</option>
                    <option value="normal" {{ request('severity') === 'normal' ? 'selected' : '' }}>Normal</option>
                    <option value="warning" {{ request('severity') === 'warning' ? 'selected' : '' }}>Peringatan</option>
                    <option value="critical" {{ request('severity') === 'critical' ? 'selected' : '' }}>Kritis</option>
                </select>
            </div>
            <div class="col-md-3">
                <select name="status" class="form-select form-select-sm">
                    <option value="">-- Semua Status --</option>
                    <option value="submitted" {{ request('status') === 'submitted' ? 'selected' : '' }}>Dikirim</option>
                    <option value="under_review" {{ request('status') === 'under_review' ? 'selected' : '' }}>Ditinjau</option>
                    <option value="processing" {{ request('status') === 'processing' ? 'selected' : '' }}>Diproses</option>
                    <option value="resolved" {{ request('status') === 'resolved' ? 'selected' : '' }}>Selesai</option>
                </select>
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary btn-sm w-100">
                    <i class="bi bi-search"></i> Filter
                </button>
            </div>
        </div>
    </form>

    <!-- Reports List -->
    <div class="row g-4">
        @forelse($reports as $report)
            <div class="col-md-6">
                <div class="card h-100">
                    @if($report->image_path)
                        <img src="{{ asset('storage/' . $report->image_path) }}" class="card-img-top" alt="{{ $report->title }}" style="height: 200px; object-fit: cover;">
                    @else
                        <div style="height: 200px; background: linear-gradient(135deg, #4caf50 0%, #45a049 100%); display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-tree" style="font-size: 3rem; color: white; opacity: 0.3;"></i>
                        </div>
                    @endif
                    <div class="card-body">
                        <h5 class="card-title fw-bold">{{ $report->title }}</h5>
                        <p class="card-text" style="height: 60px; overflow: hidden; text-overflow: ellipsis;">
                            {{ Str::limit($report->description, 100) }}
                        </p>
                        
                        <div class="mb-3">
                            <div>
                                <span class="badge bg-info">{{ $report->category }}</span>
                                @if($report->severity === 'critical')
                                    <span class="badge bg-danger">⚠️ Kritis</span>
                                @elseif($report->severity === 'warning')
                                    <span class="badge bg-warning">Peringatan</span>
                                @else
                                    <span class="badge bg-secondary">Normal</span>
                                @endif
                            </div>
                        </div>

                        <small class="text-muted d-block mb-2">
                            <i class="bi bi-geo-alt"></i> {{ Str::limit($report->location_address, 50) }}
                        </small>
                        <small class="text-muted d-block mb-2">
                            <i class="bi bi-person"></i> {{ $report->user->name }}
                        </small>
                        <small class="text-muted">
                            <i class="bi bi-calendar"></i> {{ $report->created_at->format('d F Y') }}
                        </small>

                        <div class="mt-3">
                            @if($report->status === 'submitted')
                                <span class="badge bg-primary">Dikirim</span>
                            @elseif($report->status === 'under_review')
                                <span class="badge bg-info">Ditinjau</span>
                            @elseif($report->status === 'processing')
                                <span class="badge bg-warning">Diproses</span>
                            @elseif($report->status === 'resolved')
                                <span class="badge bg-success">Selesai</span>
                            @endif
                        </div>
                    </div>
                    <div class="card-footer bg-white">
                        <a href="{{ route('environmental.show', $report) }}" class="btn btn-sm btn-outline-primary w-100">
                            <i class="bi bi-arrow-right"></i> Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">
                    <i class="bi bi-info-circle"></i> Belum ada laporan lingkungan
                </div>
            </div>
        @endforelse
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $reports->links() }}
    </div>
</div>
@endsection
