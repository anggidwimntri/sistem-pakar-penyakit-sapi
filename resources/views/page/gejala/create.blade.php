@extends('layouts.app-portal')

@section('title', 'Tambah Pengguna')

@section('content')
    <div class="mb-4">
        <h2 class="page-title">Tambah Gejala Baru</h2>
        <p class="page-subtitle mb-0">Masukkan informasi kode dan keterangan gejala klinis baru.</p>
    </div>

    <div class="card border-0 shadow-sm p-4" style="border-radius: 15px;">
        <form action="
            @if(auth()->user()->role === 'admin')
                {{ route('admin.gejala.store') }}
            @else
                {{ route('pakar.gejala.store') }}
            @endif
            " method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label fw-bold">Kode Gejala</label>
                <input type="text" name="kode_gejala" class="form-control" placeholder="Contoh: G01" value="{{ old('kode_gejala') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Nama Gejala</label>
                <input type="text" name="nama_gejala" class="form-control" placeholder="Contoh: Demam tinggi / Suhu tubuh di atas normal" value="{{ old('nama_gejala') }}" required>
            </div>

            <div class="d-flex justify-content-end gap-2">
                <a href="
                    @if(auth()->user()->role === 'admin')
                        {{ route('admin.gejala.index') }}
                    @else
                        {{ route('pakar.gejala.index') }}
                    @endif
                        " class="btn btn-light px-4">Batal</a>
                <button type="submit" class="btn btn-success px-4">Simpan Data</button>
            </div>
        </form>
    </div>
@endsection