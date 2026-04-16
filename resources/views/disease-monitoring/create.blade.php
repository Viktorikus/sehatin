@extends('layouts.app')

@section('title', 'Laporkan Penyakit - Sehatin')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-virus"></i> Laporkan Penyakit
                    </h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">
                        Laporan Anda akan membantu pemerintah dan masyarakat dalam memantau situasi kesehatan publik. Data yang Anda berikan akan ditangani dengan profesional.
                    </p>

                    <form action="{{ route('disease.store') }}" method="POST">
                        @csrf

                        <!-- Nama Penyakit -->
                        <div class="mb-3">
                            <label for="disease_name" class="form-label fw-bold">
                                Nama Penyakit <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control @error('disease_name') is-invalid @enderror" 
                                   id="disease_name" name="disease_name" 
                                   placeholder="Cth: Demam Berdarah, Batuk, Flu" 
                                   value="{{ old('disease_name') }}" required>
                            @error('disease_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Tanggal Mulai Gejala -->
                        <div class="mb-3">
                            <label for="symptom_start_date" class="form-label fw-bold">
                                Tanggal Mulai Gejala <span class="text-danger">*</span>
                            </label>
                            <input type="date" class="form-control @error('symptom_start_date') is-invalid @enderror" 
                                   id="symptom_start_date" name="symptom_start_date" 
                                   value="{{ old('symptom_start_date') }}" required>
                            @error('symptom_start_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Gejala -->
                        <div class="mb-3">
                            <label for="symptoms" class="form-label fw-bold">
                                Deskripsi Gejala <span class="text-danger">*</span>
                            </label>
                            <textarea class="form-control @error('symptoms') is-invalid @enderror" 
                                      id="symptoms" name="symptoms" rows="4" 
                                      placeholder="Jelaskan gejala yang Anda alami secara detail"
                                      required>{{ old('symptoms') }}</textarea>
                            @error('symptoms')
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
                                <option value="">-- Pilih Tingkat Keparahan --</option>
                                <option value="mild" {{ old('severity') === 'mild' ? 'selected' : '' }}>Ringan</option>
                                <option value="moderate" {{ old('severity') === 'moderate' ? 'selected' : '' }}>Sedang</option>
                                <option value="severe" {{ old('severity') === 'severe' ? 'selected' : '' }}>Berat</option>
                            </select>
                            @error('severity')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Lokasi -->
                        <div class="mb-3">
                            <label for="location_description" class="form-label fw-bold">
                                Lokasi / Wilayah <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control @error('location_description') is-invalid @enderror" 
                                   id="location_description" name="location_description" 
                                   placeholder="Cth: Jl. Merdeka No.123, Kota Jakarta" 
                                   value="{{ old('location_description') }}" required>
                            @error('location_description')
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

                        <!-- Puskesmas Terkait (Optional) -->
                        <div class="mb-4">
                            <label for="health_center_id" class="form-label fw-bold">Puskesmas Terkait (Opsional)</label>
                            <select class="form-select @error('health_center_id') is-invalid @enderror" 
                                    id="health_center_id" name="health_center_id">
                                <option value="">-- Pilih Puskesmas --</option>
                                @foreach($healthCenters as $center)
                                    <option value="{{ $center->id }}" {{ old('health_center_id') == $center->id ? 'selected' : '' }}>
                                        {{ $center->name }} - {{ $center->city }}
                                    </option>
                                @endforeach
                            </select>
                            @error('health_center_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Terms -->
                        <div class="mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="terms" required>
                                <label class="form-check-label" for="terms">
                                    Saya menyatakan bahwa informasi yang saya berikan adalah benar dan akurat
                                </label>
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('disease.index') }}" class="btn btn-outline-secondary">
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
