@extends('layouts.app-portal')

@section('title', 'Data Gejala - Sistem Pakar')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="page-title">Data Gejala</h2>
            <p class="page-subtitle mb-0">Kelola daftar gejala klinis yang biasa dialami oleh ternak sapi.</p>
        </div>

        @if(auth()->user()->role === 'admin')
            <a href="{{ route('admin.gejala.create') }}" class="btn btn-success fw-semibold px-3 py-2">
                <i class="bi bi-plus-lg me-1"></i> Tambah Pengetahuan
            </a>
        @elseif(auth()->user()->role === 'pakar')
            <a href="{{ route('pakar.gejala.create') }}" class="btn btn-success fw-semibold px-3 py-2">
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
        <table class="table mb-0">
            <thead>
                <tr>
                    <th width="15%">KODE</th>
                    <th width="35%">NAMA GEJALA</th>
                    <th width="15%" class="text-center">AKSI</th>
                </tr>
            </thead>
            <tbody>
                @forelse($gejalas as $item)
                    <tr>
                        <td class="fw-bold text-success">{{ $item->kode_gejala }}</td>
                        <td class="fw-semibold">{{ $item->nama_gejala }}</td>
                        <td class="text-center">
                            @if(auth()->user()->role === 'admin')
                                <a href="{{ route('admin.gejala.edit', $item->id) }}" class="btn btn-sm btn-light text-primary me-1" title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('admin.gejala.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus aturan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-light text-danger" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            @else
                                {{-- Pakar bisa Edit & Hapus aturan --}}
                                <a href="{{ route('pakar.gejala.edit', $item->id) }}" class="btn btn-sm btn-light text-success me-1" title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('pakar.gejala.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus aturan ini?')">
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
                        <td colspan="4" class="text-center text-muted py-4">
                            Belum ada data gejala yang terdaftar.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection