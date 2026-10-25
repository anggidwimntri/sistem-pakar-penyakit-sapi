@extends('layouts.app-portal')

@section('title', 'Detail Hasil Konsultasi - Sistem Pakar')

@section('content')
    <!-- Gunakan container-fluid agar memenuhi lebar area konten dashboard/portal -->
    <div class="container-fluid px-0">
        
        <!-- Header & Tombol Kembali -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="page-title fw-bold">Detail Laporan Konsultasi</h2>
                <p class="page-subtitle text-muted mb-0">Rekapitulasi lengkap hasil diagnosis kesehatan ternak sapi.</p>
            </div>
            
 @php
    $role = auth()->user()->role ?? 'user';
    
    // Tentukan prefix route berdasarkan role
    if ($role === 'admin') {
        $routeName = 'admin.riwayat.index';
    } elseif ($role === 'pakar') {
        $routeName = 'pakar.riwayat.index';
    } elseif ($role === 'petugas') {
        $routeName = 'petugas.riwayat.index';
    } else {
        $routeName = 'riwayat.saya'; // Atau sesuaikan dengan nama route user kamu
    }
@endphp

<a href="{{ route($routeName) }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
    <i class="bi bi-arrow-left me-1"></i> Kembali ke Riwayat
</a>
        </div>

        <div class="row g-4">
            <!-- Kolom Kiri: Informasi Peternak & Nilai Algoritma (Lebar proporsional 4 kolom) -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 p-4 sticky-top" style="top: 20px;">
                    
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <div class="text-uppercase text-muted fw-bold" style="font-size: 0.75rem; letter-spacing: 0.5px;">Pemilik & Lokasi</div>
                            <h4 class="fw-bold text-dark mb-1">{{ $riwayat->nama_peternak }}</h4>
                            <div class="text-muted small">
                                <i class="bi bi-geo-alt me-1"></i> {{ $riwayat->alamat }}
                            </div>
                        </div>
                        <div>
                            <span class="badge bg-success bg-opacity-15 text-success px-3 py-2 rounded-pill fw-bold">SAPI ACEH</span>
                        </div>
                    </div>

                    <hr class="text-muted opacity-25">

                    <!-- Diagnosis Utama -->
                    <div class="p-3 bg-danger bg-opacity-10 border-start border-danger border-4 rounded-3 my-3">
                        <span class="d-block text-danger fw-bold small text-uppercase">Diagnosis Penyakit</span>
                        <h3 class="fw-bold text-dark mb-0 mt-1">{{ strtoupper($riwayat->penyakit_terdeteksi) }}</h3>
                    </div>

                    <!-- Perbandingan Skor Metode -->
                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <div class="p-3 bg-light rounded-3 text-center">
                                <span class="text-muted small d-block">Kepastian (CF)</span>
                                <h4 class="fw-bold text-success mb-0">{{ number_format($riwayat->persentase_cf, 2) }}%</h4>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-3 bg-light rounded-3 text-center">
                                <span class="text-muted small d-block">Probabilitas (NB)</span>
                                <h4 class="fw-bold text-primary mb-0">{{ number_format($riwayat->probabilitas_nb ?? 0, 2) }}%</h4>
                            </div>
                        </div>
                    </div>

                    <div class="text-muted small text-center mt-2">
                        <i class="bi bi-clock-history me-1"></i> Waktu: {{ $riwayat->created_at->format('d M Y, H:i') }} WIB
                    </div>
                </div>
            </div>

            <!-- Kolom Kanan: Penanganan, Deskripsi, dan Gejala Beserta Nilainya (Lebar 8 kolom) -->
            <div class="col-lg-8">
                
                @php
                    // Ambil referensi data penyakit (opsional jika ingin menampilkan deskripsi/solusi tambahan)
                    $penyakitData = \App\Models\Penyakit::with('artikel')->where('nama_penyakit', $riwayat->penyakit_terdeteksi)->first();
                    
                    // Label teks tingkat keyakinan user (CF User)
                    $labelsKeyakinan = [
                        '1.0' => 'Pasti (100%)',
                        '0.8' => 'Hampir Pasti (80%)',
                        '0.6' => 'Kemungkinan Besar (60%)',
                        '0.4' => 'Mungkin (40%)',
                        '0.2' => 'Sedikit Ragu (20%)',
                        '0.0' => 'Tidak Tahu / Tidak Yakin (0%)'
                    ];
                @endphp

                <!-- Daftar Gejala Klinis Beserta Nilai Keyakinan Pengguna -->
                <div class="card border-0 shadow-sm rounded-4 p-4">
                    <h5 class="fw-bold text-dark mb-3">
                        <i class="bi bi-ui-checks text-success me-2"></i>Gejala & Tingkat Keyakinan yang Dilaporkan
                    </h5>
                    <p class="text-muted small mb-3">Indikasi klinis serta tingkat kepastian yang diinput saat konsultasi:</p>
                    
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th width="10%">KODE</th>
                                    <th width="50%">GEJALA KLINIS</th>
                                    <th width="40%">TINGKAT KEYAKINAN (USER)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($gejalaTerpilih as $g)
                                    @php
                                        // Ambil bobot user berdasarkan ID gejala dari map yang dikirim controller
                                        $bobotUser = $gejalaDataMap[$g->id] ?? '1.0';
                                        $teksKeyakinan = $labelsKeyakinan[(string)$bobotUser] ?? "Bobot: $bobotUser";
                                    @endphp
                                    <tr>
                                        <td><span class="badge bg-secondary bg-opacity-10 text-dark fw-bold">{{ $g->kode_gejala }}</span></td>
                                        <td class="fw-semibold text-secondary">{{ $g->nama_gejala }}</td>
                                        <td>
                                            <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill fw-bold">
                                                <i class="bi bi-check-circle me-1"></i> {{ $teksKeyakinan }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center text-muted fst-italic py-3">Rincian gejala tidak ditemukan.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
        
    </div>
@endsection