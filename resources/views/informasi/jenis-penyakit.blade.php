@extends('layouts.app')

@section('content')
    <div class="py-5 bg-light border-bottom">
        <div class="container text-center">
            <h1 class="fw-bold text-dark">Daftar Penyakit Sapi Menular</h1>
            <p class="text-muted mb-0">Kenali jenis-jenis penyakit menular pada sapi serta karakteristik gejalanya di Kabupaten Aceh Utara.</p>
        </div>
    </div>

    <div class="container py-5">
        <div class="row g-4">
            @forelse($artikels as $item)
                <div class="col-md-6 col-lg-4">
                    <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden">
                        <!-- Tampilkan Gambar jika ada, jika tidak pakai gambar default -->
                        @if($item->gambar)
                            <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->penyakit->nama_penyakit }}" class="card-img-top" style="height: 200px; object-fit: cover;">
                        @else
                            <div class="bg-secondary text-white d-flex align-items-center justify-content-center" style="height: 200px;">
                                <i class="bi bi-image display-4"></i>
                            </div>
                        @endif

                        <div class="card-body p-4">
                            <span class="badge bg-success bg-opacity-10 text-success px-3 py-1 rounded-pill mb-3 fw-bold">
                                {{ $item->penyakit->kode_penyakit ?? '-' }}
                            </span>
                            <h4 class="fw-bold text-dark mb-2">{{ $item->penyakit->nama_penyakit ?? '-' }}</h4>
                            <p class="text-muted small lh-base mb-3">
                                {{ Str::limit($item->konten_lengkap, 90) }}
                            </p>
                        </div>
                        <div class="card-footer bg-white border-0 px-4 pb-4 pt-0">
                            <a href="{{ route('informasi.penyakit.detail', $item->id) }}" class="btn btn-outline-success btn-sm w-100 rounded-pill">
                                Baca Selengkapnya <i class="bi bi-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <p class="text-muted">Belum ada informasi penyakit yang ditambahkan oleh admin.</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection