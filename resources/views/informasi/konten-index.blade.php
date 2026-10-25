@extends('layouts.app-portal')

@section('content')
<div class="d-flex justify-content-between mb-4">
    <h2 class="page-title">Kelola Artikel Penyakit</h2>
    <a href="{{ route('admin.artikel.create') }}" class="btn btn-success">Tambah Artikel</a>
</div>

{{-- TAMBAHKAN KODE INI UNTUK MUNCULKAN ALERT SUKSES --}}
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="table-custom">
    <table class="table">
        <thead>
            <tr>
                <th>Penyakit</th>
                <th>Konten Singkat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($artikels as $item)
            <tr>
                <td>{{ $item->penyakit->nama_penyakit }}</td>
                <td>{{ Str::limit($item->konten_lengkap, 50) }}</td>
                <td class="text-center">
                    <a href="{{ route('admin.artikel.edit', $item->id) }}" class="btn btn-sm btn-light text-primary me-1" title="Edit">
                        <i class="bi bi-pencil-square"></i>
                    </a>
                    <form action="{{ route('admin.artikel.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus artikel ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-light text-danger" title="Hapus">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection