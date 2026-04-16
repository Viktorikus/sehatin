@extends('layouts.app')

@section('title', 'Buat Laporan Lingkungan - Sehatin')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-tree"></i> Buat Laporan Kesehatan Lingkungan
                    </h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('environmental.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Judul -->
                        <div class="mb-3">
                            <label for="title" class="form-label fw-bold">
                                Judul Laporan <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                   id="title" name="title" 
                                   placeholder="Cth: Pencemaran Air Sumur di Area Komplek" 
                                   value="{{ old('title') }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Deskripsi -->
                        <div class="mb-3">
                            <label for="description" class="form-label fw-bold">
                                Deskripsi Masalah <span class="text-danger">*</span>
                            </label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="5" 
                                      placeholder="Jelaskan masalah lingkungan yang Anda temui secara detail"
                                      required>{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Kategori -->
                        <div class="mb-3">
                            <label for="category" class="form-label fw-bold">
                                Kategori <span class="text-danger">*</span>
                            </label>
                            <select class="form-select @error('category') is-invalid @enderror" 
                                    id="category" name="category" required>
                                <option value="">-- Pilih Kategori --</option>
                                <option value="air" {{ old('category') === 'air' ? 'selected' : '' }}>Air</option>
                                <option value="sanitasi" {{ old('category') === 'sanitasi' ? 'selected' : '' }}>Sanitasi</option>
                                <option value="sampah" {{ old('category') === 'sampah' ? 'selected' : '' }}>Sampah</option>
                                <option value="polusi" {{ old('category') === 'polusi' ? 'selected' : '' }}>Polusi Udara</option>
                                <option value="lainnya" {{ old('category') === 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                            @error('category')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Tingkat Keparahan -->
                        <div class="mb-3">
                            <label for="severity" class="form-label fw-bold">
                                Tingkat Keparahan <span class="text-danger">*</span>
                            </label>
                            <select class="form-select @error('severity') is-invalid @enderror" 
                                    id="severity" name="severity" required>
                                <option value="">-- Pilih Tingkat --</option>
                                <option value="normal" {{ old('severity') === 'normal' ? 'selected' : '' }}>Normal</option>
                                <option value="warning" {{ old('severity') === 'warning' ? 'selected' : '' }}>Peringatan</option>
                                <option value="critical" {{ old('severity') === 'critical' ? 'selected' : '' }}>Kritis</option>
                            </select>
                            @error('severity')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Lokasi -->
                        <div class="mb-3">
                            <label for="location_address" class="form-label fw-bold">
                                Alamat Lokasi <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control @error('location_address') is-invalid @enderror" 
                                   id="location_address" name="location_address" 
                                   placeholder="Cth: Jl. Merdeka No.123, Kota Jakarta" 
                                   value="{{ old('location_address') }}" required>
                            @error('location_address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Koordinat (Optional) -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="latitude" class="form-label fw-bold">Latitude</label>
                                <input type="number" step="0.00000001" class="form-control @error('latitude') is-invalid @enderror" 
                                       id="latitude" name="latitude" placeholder="-6.2088" value="{{ old('latitude') }}">
                                @error('latitude')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="longitude" class="form-label fw-bold">Longitude</label>
                                <input type="number" step="0.00000001" class="form-control @error('longitude') is-invalid @enderror" 
                                       id="longitude" name="longitude" placeholder="106.8456" value="{{ old('longitude') }}">
                                @error('longitude')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Foto Bukti -->
                        <div class="mb-4">
                            <label for="image" class="form-label fw-bold">Foto Bukti (Opsional)</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" 
                                   id="image" name="image" accept="image/*">
                            <small class="text-muted">Maksimal 2MB. Format: JPG, PNG, GIF, WebP</small>
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Terms -->
                        <div class="mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="terms" required>
                                <label class="form-check-label" for="terms">
                                    Saya menyatakan bahwa informasi dan foto yang saya berikan adalah benar dan akurat
                                </label>
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('environmental.index') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-x-circle"></i> Batal
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle"></i> Kirim Laporan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
