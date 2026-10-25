@extends('layouts.app-portal')

@section('title', 'Dashboard Pakar - Sistem Pakar')

@section('content')
    <!-- Header Dashboard -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4">
        <div>
            <h2 class="page-title fw-bold">Dashboard Pakar</h2>
            <p class="page-subtitle text-muted mb-0">Halo, Pakar! Kelola basis pengetahuan dan validasi aturan sistem di sini.</p>
        </div>
    </div>

    <!-- Cards Row (4 Statistik Pakar) -->
    <div class="row g-4 mb-4">
        
        <!-- Card 1: Penyakit Terdaftar -->
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm p-4 rounded-4 bg-white h-100">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="text-uppercase fw-bold text-muted small" style="font-size: 0.75rem; letter-spacing: 0.5px;">Penyakit</span>
                    <div class="bg-success bg-opacity-10 text-success p-2 rounded-3">
                        <i class="bi bi-virus fs-5"></i>
                    </div>
                </div>
                <h3 class="fw-bold mb-0 text-dark">{{ $totalPenyakit ?? 0 }}</h3>
                <div class="text-muted small mt-1">Total Penyakit Terdata</div>
            </div>
        </div>
        
        <!-- Card 2: Total Gejala Klinis -->
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm p-4 rounded-4 bg-white h-100">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="text-uppercase fw-bold text-muted small" style="font-size: 0.75rem; letter-spacing: 0.5px;">Variabel</span>
                    <div class="bg-primary bg-opacity-10 text-primary p-2 rounded-3">
                        <i class="bi bi-ui-checks fs-5"></i>
                    </div>
                </div>
                <h3 class="fw-bold mb-0 text-dark">{{ $totalGejala ?? 0 }}</h3>
                <div class="text-muted small mt-1">Total Gejala Klinis</div>
            </div>
        </div>

        <!-- Card 3: Aturan Rule CF -->
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm p-4 rounded-4 bg-white h-100">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="text-uppercase fw-bold text-muted small" style="font-size: 0.75rem; letter-spacing: 0.5px;">Rule CF</span>
                    <div class="bg-warning bg-opacity-10 text-warning p-2 rounded-3">
                        <i class="bi bi-diagram-3 fs-5"></i>
                    </div>
                </div>
                <h3 class="fw-bold mb-0 text-dark">{{ $totalPengetahuan ?? 0 }}</h3>
                <div class="text-muted small mt-1">Aturan Terinput</div>
            </div>
        </div>

        <!-- Card 4: Konsultasi -->
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm p-4 rounded-4 bg-white h-100">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="text-uppercase fw-bold text-muted small" style="font-size: 0.75rem; letter-spacing: 0.5px;">Aktivitas</span>
                    <div class="bg-danger bg-opacity-10 text-danger p-2 rounded-3">
                        <i class="bi bi-people-fill fs-5"></i>
                    </div>
                </div>
                <h3 class="fw-bold mb-0 text-dark">{{ $totalKonsultasi ?? 0 }}</h3>
                <div class="text-muted small mt-1">Kasus Konsultasi</div>
            </div>
        </div>

    </div>

@endsection