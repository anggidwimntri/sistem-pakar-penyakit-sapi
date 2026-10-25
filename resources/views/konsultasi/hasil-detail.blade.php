@extends('layouts.app')

@section('title', 'Detail & Penanganan - Sistem Pakar')

@section('content')
<div class="container pb-5">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold">Detail Penanganan & Solusi Medis</h2>
            <p class="text-muted mb-0">Rincian diagnosis untuk ternak milik Bapak/Ibu <strong>{{ $riwayat->nama_peternak }}</strong></p>
        </div>
        <a href="javascript:history.back()" class="btn btn-outline-secondary rounded-pill px-4">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-10">
            
            <!-- 1. Kotak Penanganan & Solusi -->
            <div class="card border-0 shadow-sm rounded-4 p-4 mb-4 bg-success bg-opacity-10 border-start border-success border-4">
                <h4 class="fw-bold text-success mb-3">
                    <i class="bi bi-shield-check me-2"></i>Cara Penanganan & Solusi Medis
                </h4>
                <p class="text-dark mb-0" style="line-height: 1.8; white-space: pre-line;">
                    {{ $penyakit->artikel->penanganan ?? $penyakit->solusi ?? 'Belum ada panduan penanganan khusus untuk penyakit ini.' }}
                </p>
            </div>

            <!-- 2. Penjelasan Lengkap Penyakit -->
            <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                <h4 class="fw-bold text-dark mb-3">
                    <i class="bi bi-journal-text text-success me-2"></i>Deskripsi & Penjelasan Penyakit
                </h4>
                <p class="text-secondary" style="line-height: 1.8; white-space: pre-line;">
                    {{ $penyakit->artikel->konten_lengkap ?? $penyakit->deskripsi ?? 'Tidak ada deskripsi mendalam.' }}
                </p>
            </div>

            <!-- 3. Daftar Gejala yang Dialami -->
            <div class="card border-0 shadow-sm rounded-4 p-4">
                <h5 class="fw-bold text-dark mb-3">
                    <i class="bi bi-ui-checks text-success me-2"></i>Gejala Klinis yang Dialami
                </h5>
                <p class="text-muted small mb-3">Berikut adalah indikasi gejala yang Anda pilih saat melakukan pemeriksaan:</p>
                
                <ul class="list-group list-group-flush">
                    @forelse($gejalaTerpilih as $g)
                        @php
                            // Format Hybrid Aman (Mendukung data lama & data baru)
                            $bobotUser = $gejalaDataMap[$g->id] ?? '1.0';
                            
                            $labelsKeyakinan = [
                                '1.0' => 'Pasti (100%)', '0.8' => 'Hampir Pasti (80%)',
                                '0.6' => 'Kemungkinan Besar (60%)', '0.4' => 'Mungkin (40%)',
                                '0.2' => 'Sedikit Ragu (20%)', '0.0' => 'Tidak Yakin (0%)'
                            ];
                            $teksKeyakinan = $labelsKeyakinan[(string)$bobotUser] ?? "Bobot: $bobotUser";
                        @endphp
                        <li class="list-group-item px-0 py-3 text-secondary bg-transparent border-bottom d-flex justify-content-between align-items-center">
                            <div>
                                <i class="bi bi-check2-circle text-success me-2"></i>
                                <strong class="text-dark">[{{ $g->kode_gejala }}]</strong> {{ $g->nama_gejala }}
                            </div>
                            <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-2">
                                {{ $teksKeyakinan }}
                            </span>
                        </li>
                    @empty
                        <li class="list-group-item px-0 text-muted fst-italic bg-transparent">Data gejala tidak termuat secara spesifik.</li>
                    @endforelse
                </ul>
            </div>

        </div>
    </div>
</div>
@endsection