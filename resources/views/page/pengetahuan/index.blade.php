@extends('layouts.app-portal')

@section('title', 'Basis Pengetahuan - Sistem Pakar')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="page-title">Basis Pengetahuan (Rules CF)</h2>
            <p class="page-subtitle mb-0">Kelola aturan hubungan penyakit, gejala, serta nilai MB dan MD pakar.</p>
        </div>

        {{-- TOMBOL TAMBAH DIBUKA UNTUK ADMIN DAN PAKAR --}}
        @if(auth()->user()->role === 'admin')
            <a href="{{ route('admin.pengetahuan.create') }}" class="btn btn-success fw-semibold px-3 py-2">
                <i class="bi bi-plus-lg me-1"></i> Tambah Pengetahuan
            </a>
        @elseif(auth()->user()->role === 'pakar')
            <a href="{{ route('pakar.pengetahuan.create') }}" class="btn btn-success fw-semibold px-3 py-2">
                <i class="bi bi-plus-lg me-1"></i> Tambah Pengetahuan (Pakar)
            </a>
        @endif
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="table-custom">
        <table class="table mb-0 align-middle">
            <thead>
                <tr>
                    <th width="5%">NO</th>
                    <th width="35%">PENYAKIT</th>
                    <th width="40%">GEJALA TERKAIT</th>
                    <th width="10%" class="text-center">CF PAKAR</th>
                    <th width="10%" class="text-center">AKSI</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pengetahuans as $index => $item)
                    <tr>
                        <td class="fw-bold text-muted">{{ $index + 1 }}</td>
                        <td>
                            <span class="fw-semibold text-dark">{{ $item->penyakit->nama_penyakit ?? '-' }}</span>
                            <br><small class="text-muted">{{ $item->penyakit->kode_penyakit ?? '-' }}</small>
                        </td>
                        <td>
                            <span class="fw-semibold text-dark">{{ $item->gejala->nama_gejala ?? '-' }}</span>
                            <br><small class="text-muted">{{ $item->gejala->kode_gejala ?? '-' }}</small>
                        </td>
                        <td class="text-center fw-bold text-success">{{ $item->cf_pakar }}</td>
                        <td class="text-center">
                            @if(auth()->user()->role === 'admin')
                                <a href="{{ route('admin.pengetahuan.edit', $item->id) }}" class="btn btn-sm btn-light text-primary me-1" title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('admin.pengetahuan.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus aturan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-light text-danger" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            @else
                                {{-- Pakar bisa Edit & Hapus aturan --}}
                                <a href="{{ route('pakar.pengetahuan.edit', $item->id) }}" class="btn btn-sm btn-light text-success me-1" title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('pakar.pengetahuan.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus aturan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-light text-danger" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">
                            Belum ada basis pengetahuan yang terdaftar.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection