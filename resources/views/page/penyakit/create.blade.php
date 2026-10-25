@extends('layouts.app-portal')

@section('title', 'Tambah Penyakit')

@section('content')
    <div class="mb-4">
        <h2 class="page-title">Tambah Penyakit Baru</h2>
        <p class="page-subtitle mb-0">Masukkan informasi detail mengenai penyakit baru pada sapi.</p>
    </div>

    <div class="card border-0 shadow-sm p-4" style="border-radius: 15px;">
        <form action="
            @if(auth()->user()->role === 'admin')
                {{ route('admin.penyakit.store') }}
            @else
                {{ route('pakar.penyakit.store') }}
            @endif
        " method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label fw-bold">Kode Penyakit</label>
                <input type="text" name="kode_penyakit" class="form-control" placeholder="Contoh: P01" value="{{ old('kode_penyakit') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Nama Penyakit</label>
                <input type="text" name="nama_penyakit" class="form-control" placeholder="Contoh: Bovine Ephemeral Fever" value="{{ old('nama_penyakit') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Deskripsi</label>
                <textarea name="deskripsi" class="form-control" rows="3" placeholder="Penjelasan singkat mengenai penyakit...">{{ old('deskripsi') }}</textarea>
            </div>

            <div class="mb-4">
                <label class="form-label fw-bold">Solusi / Penanganan</label>
                <textarea name="solusi" class="form-control" rows="3" placeholder="Cara pengobatan atau pencegahan...">{{ old('solusi') }}</textarea>
            </div>

            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('admin.penyakit.index') }}" class="btn btn-light px-4">Batal</a>
                <button type="submit" class="btn btn-success px-4">Simpan Data</button>
            </div>
        </form>
    </div>
@endsection