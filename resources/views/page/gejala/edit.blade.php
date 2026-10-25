@extends('layouts.app-portal')

@section('title', 'Edit Gejala')

@section('content')
    <div class="mb-4">
        <h2 class="page-title">Edit Data Gejala</h2>
        <p class="page-subtitle mb-0">Perbarui informasi gejala klinis ternak sapi.</p>
    </div>

    <div class="card border-0 shadow-sm p-4" style="border-radius: 15px;">
        <form action="{{ auth()->user()->role === 'admin' ? route('admin.gejala.update', $gejala->id) : route('pakar.gejala.update', $gejala->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label class="form-label fw-bold">Kode Gejala</label>
                <input type="text" name="kode_gejala" class="form-control" value="{{ old('kode_gejala', $gejala->kode_gejala) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Nama Gejala</label>
                <input type="text" name="nama_gejala" class="form-control" value="{{ old('nama_gejala', $gejala->nama_gejala) }}" required>
            </div>

            <div class="d-flex justify-content-end gap-2">
                <a href="{{ auth()->user()->role === 'admin' ? route('admin.gejala.index') : route('pakar.gejala.index') }}" class="btn btn-light px-4">Batal</a>
                <button type="submit" class="btn btn-success px-4">Simpan Perubahan</button>
            </div>
        </form>
    </div>
@endsection