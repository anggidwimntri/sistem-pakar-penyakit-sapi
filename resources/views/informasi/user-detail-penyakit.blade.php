@extends('layouts.app-portal')
<title>@yield('title', 'Detail Seputar Penyakit')</title>

@section('content')
    <div class="py-4 bg-light border-bottom">
        <div class="container">
            <a href="{{ route('user.informasi') }}" class="text-decoration-none text-success small fw-bold">
                <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar Penyakit
            </a>
        </div>
    </div>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <span class="badge bg-success px-3 py-2 rounded-pill mb-3 fw-bold">
                    {{ $artikel->penyakit->kode_penyakit }}
                </span>
                <h1 class="fw-bold text-dark mb-4">{{ $artikel->penyakit->nama_penyakit }}</h1>

                <!-- Gambar Utama -->
                @if($artikel->gambar)
                    <div class="mb-4 rounded-4 overflow-hidden shadow-sm">
                        <img src="{{ asset('storage/' . $artikel->gambar) }}" alt="{{ $artikel->penyakit->nama_penyakit }}" class="w-100" style="max-height: 400px; object-fit: cover;">
                    </div>
                @endif

                <!-- Penjelasan / Deskripsi -->
                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                    <h4 class="fw-bold text-dark mb-3"><i class="bi bi-info-circle text-success me-2"></i>Tentang Penyakit</h4>
                    <p class="text-muted lh-lg mb-0" style="white-space: pre-line;">{{ $artikel->konten_lengkap }}</p>
                </div>

                <!-- Daftar Gejala Klinis Terkait (Otomatis dari Basis Pengetahuan) -->
                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                    <h4 class="fw-bold text-dark mb-3"><i class="bi bi-clipboard2-pulse text-success me-2"></i>Gejala Klinis yang Menyertai</h4>
                    <ul class="list-group list-group-flush">
                        {{-- Mengambil gejala dari relasi pengetahuan berdasarkan penyakit_id --}}
                        @forelse($artikel->penyakit->pengetahuans ?? [] as $rule)
                            <li class="list-group-item px-0 py-3 text-secondary">
                                <i class="bi bi-check2-circle text-success me-2"></i>
                                <strong>[{{ $rule->gejala->kode_gejala ?? '' }}]</strong> {{ $rule->gejala->nama_gejala ?? '' }}
                            </li>
                        @empty
                            <li class="list-group-item px-0 text-muted">Belum ada data gejala terkait untuk penyakit ini.</li>
                        @endforelse
                    </ul>
                </div>

                <!-- Cara Penanganan -->
                <div class="card border-0 shadow-sm rounded-4 p-4">
                    <h4 class="fw-bold text-dark mb-3"><i class="bi bi-shield-exclamation text-success me-2"></i>Cara Penanganan & Pencegahan</h4>
                    <p class="text-muted lh-lg mb-0" style="white-space: pre-line;">{{ $artikel->penanganan }}</p>
                </div>

            </div>
        </div>
    </div>
@endsection