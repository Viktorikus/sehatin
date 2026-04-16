@extends('layouts.app')

@section('title', 'Monitoring Penyakit Masyarakat - Sehatin')

@section('content')
<div class="container my-5">
    <div class="row mb-4">
        <div class="col-md-8">
            <h2 class="fw-bold">
                <i class="bi bi-virus" style="color: #ff9800;"></i> Monitoring Penyakit Masyarakat
            </h2>
            <p class="text-muted">Laporan penyakit dari masyarakat untuk memantau kesehatan publik</p>
        </div>
        <div class="col-md-4">
            @auth
                <a href="{{ route('disease.create') }}" class="btn btn-primary w-100 mb-2">
                    <i class="bi bi-plus-circle"></i> Laporkan Penyakit
                </a>
            @else
                <a href="{{ route('login') }}" class="btn btn-primary w-100 mb-2">
                    <i class="bi bi-box-arrow-in-right"></i> Login untuk Lapor
                </a>
            @endauth
            <a href="{{ route('disease.statistics') }}" class="btn btn-outline-primary w-100">
                <i class="bi bi-bar-chart"></i> Statistik
            </a>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <h6 class="text-muted mb-2">Total Laporan</h6>
                    <h3 class="fw-bold" style="color: #ff9800;">{{ $totalReports }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <h6 class="text-muted mb-2">Sedang Dipantau</h6>
                    <h3 class="fw-bold" style="color: var(--primary);">{{ $activeReports }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <h6 class="text-muted mb-2">Kasus Berat</h6>
                    <h3 class="fw-bold" style="color: #f44336;">{{ $severeCases }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Disease Reports List -->
    <div class="card">
        <div class="card-header bg-white border-bottom">
            <h5 class="card-title mb-0">Daftar Laporan Penyakit</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Penyakit</th>
                            <th>Pelapor</th>
                            <th>Tanggal Gejala</th>
                            <th>Tingkat Keparahan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($reports as $report)
                            <tr>
                                <td>
                                    <strong>{{ $report->disease_name }}</strong><br>
                                    <small class="text-muted">{{ $report->location_description }}</small>
                                </td>
                                <td>{{ $report->user->name }}</td>
                                <td>{{ $report->symptom_start_date->format('d F Y') }}</td>
                                <td>
                                    @if($report->severity === 'mild')
                                        <span class="badge bg-info">Ringan</span>
                                    @elseif($report->severity === 'moderate')
                                        <span class="badge bg-warning">Sedang</span>
                                    @elseif($report->severity === 'severe')
                                        <span class="badge bg-danger">Berat</span>
                                    @endif
                                </td>
                                <td>
                                    @if($report->status === 'reported')
                                        <span class="badge bg-primary">Dilaporkan</span>
                                    @elseif($report->status === 'being_monitored')
                                        <span class="badge bg-success">Dipantau</span>
                                    @elseif($report->status === 'resolved')
                                        <span class="badge bg-secondary">Selesai</span>
                                    @elseif($report->status === 'escalated')
                                        <span class="badge bg-danger">Eskalasi</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('disease.show', $report) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-eye"></i> Lihat
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">
                                    <i class="bi bi-inbox"></i> Belum ada laporan penyakit
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $reports->links() }}
    </div>
</div>
@endsection
