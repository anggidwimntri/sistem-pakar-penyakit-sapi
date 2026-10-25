@extends('layouts.app-portal')

@section('content')
    <!-- Header Sambutan & Tombol Cepat -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 pb-3 border-bottom">
        <div>
            <h2 class="page-title fw-bold text-dark">Dashboard Petugas Lapangan</h2>
            <p class="page-subtitle text-muted mb-0">Selamat datang kembali, Petugas. Pantau kasus kesehatan ternak dan bantu diagnosa peternak di sini.</p>
        </div>
        <div class="mt-3 mt-md-0">
            <!-- Tombol Pintas bagi Petugas untuk langsung membantu konsultasi -->
            <a href="{{ route('konsultasi.form') }}" class="btn btn-success btn-sm rounded-pill px-4 shadow-sm">
                <i class="bi bi-stethoscope me-1"></i> Mulai Diagnosa Baru
            </a>
        </div>
    </div>

    <!-- Cards Row (3 Statistik Utama untuk Petugas) -->
    <div class="row g-4 mb-5">
        <!-- Card 1: Total Kasus Ditangani -->
        <div class="col-md-4">
            <div class="card-stat border-0 shadow-sm p-4 rounded-4 bg-white h-100">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="stat-label-top text-uppercase fw-bold text-muted small">Aktivitas</span>
                    <div class="bg-warning bg-opacity-10 text-warning p-3 rounded-3"><i class="bi bi-people-fill fs-4"></i></div>
                </div>
                <h3 class="stat-number fw-bold mb-1">{{ $totalKonsultasi ?? 0 }}</h3>
                <div class="stat-label-bottom text-muted small">Total Kasus Konsultasi Masuk</div>
            </div>
        </div>
        
        <!-- Card 2: Referensi Penyakit -->
        <div class="col-md-4">
            <div class="card-stat border-0 shadow-sm p-4 rounded-4 bg-white h-100">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="stat-label-top text-uppercase fw-bold text-muted small">Referensi</span>
                    <div class="bg-success bg-opacity-10 text-success p-3 rounded-3"><i class="bi bi-bug-fill fs-4"></i></div>
                </div>
                <h3 class="stat-number fw-bold mb-1">{{ $totalPenyakit ?? 6 }}</h3>
                <div class="stat-label-bottom text-muted small">Jenis Penyakit Terdata</div>
            </div>
        </div>

        <!-- Card 3: Panduan / Gejala Acuan -->
        <div class="col-md-4">
            <div class="card-stat border-0 shadow-sm p-4 rounded-4 bg-white h-100">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="stat-label-top text-uppercase fw-bold text-muted small">Variabel</span>
                    <div class="bg-primary bg-opacity-10 text-primary p-3 rounded-3"><i class="bi bi-ui-checks fs-4"></i></div>
                </div>
                <h3 class="stat-number fw-bold mb-1">{{ $totalGejala ?? 25 }}</h3>
                <div class="stat-label-bottom text-muted small">Total Gejala Klinis Acuan</div>
            </div>
        </div>
    </div>

    <!-- Table Section: Riwayat Konsultasi Terbaru -->
    <div class="card border-0 shadow-sm rounded-4 p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="fw-bold text-dark mb-0">Daftar Konsultasi Terbaru di Lapangan</h5>
            <!-- Arahkan rute ke riwayat khusus petugas -->
            <a href="" class="btn btn-sm btn-outline-success rounded-pill px-3">
                Lihat Semua <i class="bi bi-arrow-right ms-1"></i>
            </a>
        </div>

        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead class="table-light text-uppercase fs-7">
                    <tr>
                        <th class="py-3">Peternak</th>
                        <th class="py-3">Alamat</th>
                        <th class="py-3">Penyakit Terdeteksi</th>
                        <th class="py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($riwayats as $r)
                        <tr>
                            <td class="fw-semibold py-3">{{ $r->nama_peternak }}</td>
                            <td class="text-muted py-3">{{ $r->alamat }}</td>
                            <td class="py-3">
                                <span class="badge bg-danger bg-opacity-10 text-danger px-3 py-2 rounded-pill fw-bold">
                                    {{ $r->penyakit_terdeteksi }}
                                </span>
                            </td>
                            <td class="text-center py-3">
                                <!-- Arahkan rute detail ke petugas -->
                                <a href="" class="btn btn-sm btn-light text-success border" title="Lihat Detail">
                                    <i class="bi bi-eye"></i> Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-5">
                                <i class="bi bi-inbox display-4 d-block mb-2 text-secondary opacity-50"></i>
                                Belum ada data riwayat konsultasi tercatat.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection