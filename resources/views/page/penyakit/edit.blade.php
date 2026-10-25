@extends('layouts.app-portal')

@section('title', 'Edit Penyakit')

@section('content')
    <div class="mb-4">
        <h2 class="page-title">Edit Data Penyakit</h2>
        <p class="page-subtitle mb-0">Perbarui informasi penyakit pada ternak sapi.</p>
    </div>

    <div class="card border-0 shadow-sm p-4" style="border-radius: 15px;">
        <form action="
            @if(auth()->user()->role === 'admin')
                {{ route('admin.penyakit.update', $penyakit->id) }}
            @else
                {{ route('pakar.penyakit.update', $penyakit->id) }}
            @endif
         " method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label class="form-label fw-bold">Kode Penyakit</label>
                <input type="text" name="kode_penyakit" class="form-control" value="{{ old('kode_penyakit', $penyakit->kode_penyakit) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Nama Penyakit</label>
                <input type="text" name="nama_penyakit" class="form-control" value="{{ old('nama_penyakit', $penyakit->nama_penyakit) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Deskripsi</label>
                <textarea name="deskripsi" class="form-control" rows="3">{{ old('deskripsi', $penyakit->deskripsi) }}</textarea>
            </div>

            <div class="mb-4">
                <label class="form-label fw-bold">Solusi / Penanganan</label>
                <textarea name="solusi" class="form-control" rows="3">{{ old('solusi', $penyakit->solusi) }}</textarea>
            </div>

            <div class="d-flex justify-content-end gap-2">
                <a href="
                    @if(auth()->user()->role === 'admin')
                        {{ route('admin.penyakit.index') }}
                    @else
                        {{ route('pakar.penyakit.index') }}
                    @endif" class="btn btn-light px-4">Batal</a>
                <button type="submit" class="btn btn-success px-4">Simpan Perubahan</button>
            </div>
        </form>
    </div>
@endsection