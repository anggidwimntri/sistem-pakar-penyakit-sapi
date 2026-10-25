@extends('layouts.app-portal')

@section('content')
    <!-- Banner Sambutan & Aksi Cepat -->
    <div class="card border-0 shadow-sm rounded-4 p-4 mb-4 bg-success text-white">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h2 class="fw-bold mb-2">Selamat Datang, {{ Auth::user()->name }}! 👋</h2>
                <p class="mb-3 opacity-75">Apakah sapi Anda menunjukkan gejala sakit? Lakukan diagnosa mandiri menggunakan metode Certainty Factor sekarang juga untuk mengetahui penanganan awalnya.</p>
                <a href="{{ route('user.konsultasi') }}" class="btn btn-light text-success fw-bold px-4 py-2 rounded-pill shadow-sm">
                    <i class="bi bi-hospital me-2"></i> Mulai Konsultasi Sekarang
                </a>
            </div>
            <div class="col-lg-4 text-center d-none d-lg-block">
                <i class="bi bi-shield-plus display-1 opacity-50"></i>
            </div>
        </div>
    </div>

    <!-- Cards Statistik Ringkas untuk User -->
    <div class="row g-4 mb-4">
        <!-- Total Konsultasi yang Pernah Dilakukan User Ini -->
        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-4 rounded-4 bg-white h-100">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="text-uppercase fw-bold text-muted small">Riwayat Anda</span>
                    <div class="bg-success bg-opacity-10 text-success p-2 rounded-3"><i class="bi bi-journal-medical fs-5"></i></div>
                </div>
                <h3 class="fw-bold mb-0">{{ $totalRiwayatSaya ?? 0 }}</h3>
                <small class="text-muted">Total Konsultasi Dilakukan</small>
            </div>
        </div>
        
        <!-- Total Referensi Penyakit Tersedia -->
        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-4 rounded-4 bg-white h-100">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="text-uppercase fw-bold text-muted small">Edukasi</span>
                    <div class="bg-primary bg-opacity-10 text-primary p-2 rounded-3"><i class="bi bi-book-half fs-5"></i></div>
                </div>
                <h3 class="fw-bold mb-0">{{ $totalPenyakit ?? 6 }}</h3>
                <small class="text-muted">Penyakit Sapi Terdata</small>
            </div>
        </div>

        <!-- Panduan Singkat -->
        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-4 rounded-4 bg-white h-100">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="text-uppercase fw-bold text-muted small">Bantuan</span>
                    <div class="bg-warning bg-opacity-10 text-warning p-2 rounded-3"><i class="bi bi-info-circle fs-5"></i></div>
                </div>
                <h3 class="fw-bold mb-0">24/7</h3>
                <small class="text-muted">Sistem Konsultasi Online</small>
            </div>
        </div>
    </div>

    <!-- Tabel Riwayat Konsultasi Milik User Tersebut -->
    <div class="card border-0 shadow-sm rounded-4 p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="fw-bold text-dark mb-0">Riwayat Konsultasi Terakhir Anda</h5>
            <a href="{{ route('riwayat.saya') }}" class="btn btn-sm btn-outline-success rounded-pill px-3">
                Lihat Semua <i class="bi bi-arrow-right ms-1"></i>
            </a>
        </div>

        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead class="table-light text-uppercase fs-7">
                    <tr>
                        <th class="py-3">Tanggal</th>
                        <th class="py-3">Penyakit Terdeteksi</th>
                        <th class="py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($riwayats as $r)
                        <tr>
                            <td class="text-muted py-3">{{ $r->created_at->format('d M Y, H:i') }}</td>
                            <td class="py-3">
                                <span class="badge bg-danger bg-opacity-10 text-danger px-3 py-2 rounded-pill fw-bold">
                                    {{ $r->penyakit_terdeteksi }}
                                </span>
                            </td>
                            <td class="text-center py-3">
                                <!-- Arahkan rute detail riwayat user -->
                                <a href="{{ route('user.riwayat.detail', $r->id) }}" class="btn btn-sm btn-light text-success border" title="Lihat Detail">
                                    <i class="bi bi-eye"></i> Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-5">
                                <i class="bi bi-clipboard-x display-4 d-block mb-2 text-secondary opacity-50"></i>
                                Anda belum pernah melakukan konsultasi kesehatan sapi. <br>
                                <a href="{{ route('user.konsultasi') }}" class="btn btn-success btn-sm mt-3 rounded-pill px-4">Mulai Konsultasi Sekarang</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection