<!-- Menggunakan kerangka induk dari layouts/app.blade.php -->
@extends('layouts.app')

@section('title', 'Hasil Pemeriksaan - Sistem Pakar')

@section('content')
    <div class="container pb-5">
        
        <!-- Judul Halaman -->
        <div class="text-center mb-4">
            <div class="subtitle-hasil text-muted fw-bold">HASIL PEMERIKSAAN</div>
            <h1 class="title-hasil fw-bold">Laporan Klinis Ternak</h1>
        </div>

        <div class="row justify-content-center">
            <!-- Kolom Ringkasan Utama (Dibuat di tengah dengan col-md-6 atau col-lg-5) -->
            <div class="col-lg-6 col-md-8 mb-4">
                <div class="card shadow-sm border-0 rounded-4 p-4">
                    
                    <!-- Info Peternak & Lokasi -->
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <div class="text-muted small fw-bold text-uppercase mb-1">Pemilik & Lokasi</div>
                            <h4 class="fw-bold mb-1">{{ $riwayat->nama_peternak }}</h4>
                            <div class="text-muted small">
                                <i class="bi bi-geo-alt me-1"></i> {{ $riwayat->alamat }}
                            </div>
                        </div>
                        <div>
                            <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill fw-bold">SAPI KAB. ACEH UTARA</span>
                        </div>
                    </div>

                    <hr class="text-muted opacity-25">

                    <!-- Diagnosis Utama -->
                    <div class="p-3 bg-danger bg-opacity-10 border-start border-danger border-4 rounded-3 my-3">
                        <span class="d-block text-danger fw-bold small text-uppercase">Diagnosis Utama</span>
                        <h2 class="fw-bold text-dark mb-0 mt-1">{{ strtoupper($topResult['penyakit']->nama_penyakit) }}</h2>
                    </div>

                    <!-- Nilai Perhitungan Algoritma -->
                    <div class="row g-3 mb-4">
                        <div class="col-6">
                            <div class="text-center p-3 bg-light rounded-3">
                                <div class="small text-muted mb-1">Kepastian (CF)</div>
                                <h3 class="text-success fw-bold mb-0">{{ $topResult['cf_score'] }} <span class="fs-6 text-muted">%</span></h3>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-center p-3 bg-light rounded-3">
                                <div class="small text-muted mb-1">Probabilitas (NB)</div>
                                <h3 class="text-primary fw-bold mb-0">{{ $topResult['nb_score'] }} <span class="fs-6 text-muted">%</span></h3>
                            </div>
                        </div>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="d-grid gap-2">
                        <!-- Tombol Menuju Halaman Detail Baru -->
                        <a href="{{ route('konsultasi.detail-publik', $riwayat->id) }}" class="btn btn-primary fw-semibold rounded-3 py-2">
                            <i class="bi bi-journal-medical me-2"></i> Lihat Detail Penanganan & Gejala
                        </a>
                        
                        <button onclick="window.print()" class="btn btn-outline-secondary fw-semibold rounded-3 py-2">
                            <i class="bi bi-printer me-2"></i> Cetak Ringkasan
                        </button>
                    </div>

                </div>
            </div>
        </div>
        
    </div>
@endsection