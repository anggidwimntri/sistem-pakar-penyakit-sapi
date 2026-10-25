@extends('layouts.app-portal')

@section('title', 'Data Penyakit & Gejala')

@section('content')
    <div class="container py-4">
        
        <!-- Judul Halaman -->
        <div class="text-center mb-5">
            <h1 class="page-title">Basis Pengetahuan</h1>
            <p class="text-muted">Kelola dan lihat daftar referensi data penyakit menular pada sapi beserta gejala klinis terkait.</p>
        </div>

        <!-- Tabel Utama: DATA PENYAKIT & GEJALA TERKAIT -->
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="card-header bg-white py-3 px-4 border-0">
                <h5 class="mb-0 fw-bold text-dark">Daftar Penyakit Menular Sapi & Gejala Klinisnya</h5>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light text-uppercase fs-7">
                        <tr>
                            <th class="py-3 px-4" style="width: 5%;">No</th>
                            <th class="py-3" style="width: 20%;">Penyakit</th>
                            <th class="py-3" style="width: 40%;">Gejala Klinis Terkait</th>
                            <th class="py-3" style="width: 35%;">Solusi / Penanganan Awal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($penyakits as $index => $p)
                        <tr>
                            <td class="px-4 fw-bold text-muted">{{ $index + 1 }}</td>
                            <td>
                                <span class="d-block fw-semibold text-dark">{{ $p->nama_penyakit }}</span>
                                <small class="text-muted">{{ $p->kode_penyakit ?? 'P0' . $p->id }}</small>
                            </td>
                            <td>
                                @if($p->gejalas->isEmpty())
                                    <span class="text-muted fst-italic small">Belum ada gejala diatur</span>
                                @else
                                    <div class="d-flex flex-wrap gap-1">
                                        @foreach($p->gejalas as $g)
                                            <span class="badge bg-light text-dark border px-2 py-1 fw-normal" title="{{ $g->nama_gejala }}">
                                                <strong>{{ $g->kode_gejala }}</strong>: {{ Str::limit($g->nama_gejala, 40) }}
                                            </span>
                                        @endforeach
                                    </div>
                                @endif
                            </td>
                            <td class="text-muted small">{{ Str::limit($p->solusi ?? '-', 100) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection