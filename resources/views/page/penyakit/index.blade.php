@extends('layouts.app-portal')

@section('title', 'Data Penyakit - Sistem Pakar')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="page-title">Data Penyakit</h2>
            <p class="page-subtitle mb-0">Kelola daftar jenis penyakit pada ternak sapi dan solusinya.</p>
        </div>
        @if(auth()->user()->role === 'admin')
            <a href="{{ route('admin.penyakit.create') }}" class="btn btn-success fw-semibold px-3 py-2">
                <i class="bi bi-plus-lg me-1"></i> Tambah Pengetahuan
            </a>
        @elseif(auth()->user()->role === 'pakar')
            <a href="{{ route('pakar.penyakit.create') }}" class="btn btn-success fw-semibold px-3 py-2">
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
                    <th width="10%">KODE</th>
                    <th width="25%">NAMA PENYAKIT</th>
                    <th width="40%">DESKRIPSI</th>
                    <th width="25%" class="text-center">AKSI</th>
                </tr>
            </thead>
            <tbody>
                @forelse($penyakits as $item)
                    <tr>
                        <td class="fw-bold text-success">{{ $item->kode_penyakit }}</td>
                        <td class="fw-semibold">{{ $item->nama_penyakit }}</td>
                        <td class="text-muted small">{{ Str::limit($item->deskripsi, 60) }}</td>
                        <td class="text-center">
                             @if(auth()->user()->role === 'admin')
                                <a href="{{ route('admin.penyakit.edit', $item->id) }}" class="btn btn-sm btn-light text-primary me-1" title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('admin.penyakit.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus aturan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-light text-danger" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            @else
                                {{-- Pakar bisa Edit & Hapus aturan --}}
                                <a href="{{ route('pakar.penyakit.edit', $item->id) }}" class="btn btn-sm btn-light text-success me-1" title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('pakar.penyakit.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus aturan ini?')">
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
                            Belum ada data penyakit yang terdaftar.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection