@extends('layouts.app-portal')
<!-- Mengisi bagian @yield('title') -->
@section('title', 'Formulir Konsultasi - Sistem Pakar')

<!-- Mengisi bagian @yield('content') -->
@section('content')
    

    <!-- Konten Utama -->
    <div class="container pb-5">
        
        <!-- Judul Halaman -->
        <div class="text-center mb-4">
            <div class="subtitle-hasil">HASIL PEMERIKSAAN</div>
            <h1 class="title-hasil">Laporan Klinis Ternak</h1>
        </div>

        <!-- Kartu Laporan -->
        <div class="card-laporan">
            
            <!-- Info Peternak & Lokasi -->
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="label-text mb-1">Pemilik & Lokasi</div>
                    <div class="peternak-name">{{ $riwayat->nama_peternak }}</div>
                    <div class="text-muted" style="font-size: 0.9rem;">
                        <i class="bi bi-geo-alt me-1"></i> {{ $riwayat->alamat }}
                    </div>
                </div>
                <div>
                    <span class="badge-sapi">SAPI ACEH</span>
                </div>
            </div>

            <!-- Diagnosis Utama (Highlight Box) -->
            <div class="diagnosis-box">
                <span class="diagnosis-label">Diagnosis Utama</span>
                <h2 class="diagnosis-value">{{ strtoupper($topResult['penyakit']->nama_penyakit) }}</h2>
            </div>

            <!-- Nilai Perhitungan Algoritma -->
            <div class="row g-3">
                <div class="col-6">
                    <div class="stat-box">
                        <div class="label-text">Kepastian (CF)</div>
                        <h3 class="stat-value">{{ $topResult['cf_score'] }} <span class="fs-5 text-muted">%</span></h3>
                    </div>
                </div>
                <div class="col-6">
                    <div class="stat-box">
                        <div class="label-text">Probabilitas (NB)</div>
                        <h3 class="stat-value">{{ $topResult['nb_score'] }} <span class="fs-5 text-muted">%</span></h3>
                    </div>
                </div>
            </div>

            <!-- Tombol Aksi Opsional (Cetak & Kembali) -->
            <div class="action-buttons">
                <button onclick="window.print()" class="btn btn-outline-success w-100 fw-semibold rounded-3 py-2">
                    <i class="bi bi-printer me-2"></i> Cetak Laporan
                </button>
            </div>
            
        </div>
        
    </div>

@endsection

