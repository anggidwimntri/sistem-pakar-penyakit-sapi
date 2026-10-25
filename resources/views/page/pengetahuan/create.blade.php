@extends('layouts.app-portal')

@section('title', 'Tambah Basis Pengetahuan')

@section('content')
    <div class="mb-4">
        <h2 class="page-title">Tambah Basis Pengetahuan (CF)</h2>
        <p class="page-subtitle mb-0">Tentukan nilai MB dan MD dari pakar untuk relasi penyakit dan gejala.</p>
    </div>

    <div class="card border-0 shadow-sm p-4" style="border-radius: 15px;">
        
        {{-- MENGGUNAKAN @if UNTUK MENENTUKAN ACTION ROUTE --}}
        <form action="
            @if(auth()->user()->role === 'admin')
                {{ route('admin.pengetahuan.store') }}
            @else
                {{ route('pakar.pengetahuan.store') }}
            @endif
        " method="POST">
            @csrf
            
            <div class="mb-3">
                <label class="form-label fw-bold">Pilih Penyakit</label>
                <select name="penyakit_id" class="form-select" required>
                    <option value="" disabled selected>-- Pilih Penyakit --</option>
                    @foreach($penyakits as $p)
                        <option value="{{ $p->id }}" {{ old('penyakit_id') == $p->id ? 'selected' : '' }}>
                            [{{ $p->kode_penyakit }}] {{ $p->nama_penyakit }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Pilih Gejala</label>
                <select name="gejala_id" class="form-select" required>
                    <option value="" disabled selected>-- Pilih Gejala --</option>
                    @foreach($gejalas as $g)
                        <option value="{{ $g->id }}" {{ old('gejala_id') == $g->id ? 'selected' : '' }}>
                            [{{ $g->kode_gejala }}] {{ $g->nama_gejala }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Nilai MB (Seberapa Yakin?)</label>
                    <input type="number" step="0.1" min="0" max="1" name="mb" class="form-control" placeholder="Contoh: 0.8" value="{{ old('mb') }}" required>
                    <small class="text-muted">Isi antara 0.1 s.d 1.0. Semakin yakin gejala ini milik penyakit tersebut, semakin mendekati 1.</small>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Nilai MD (Seberapa Ragu / Tidak Yakin?)</label>
                    <input type="number" step="0.1" min="0" max="1" name="md" class="form-control" placeholder="Contoh: 0.2" value="{{ old('md') }}" required>
                    <small class="text-muted">Isi antara 0.0 s.d 1.0. Jika ragu atau gejala ini bisa jadi milik penyakit lain, beri nilai (biasanya cukup 0 atau 0.1)</small>
                </div>
            </div>

            <div class="alert alert-info py-2 small mb-4">
                 <i class="bi bi-info-circle me-1"></i> <strong>Catatan untuk Pakar:</strong> Nilai akhir (CF) akan dihitung otomatis oleh sistem menggunakan rumus: <code>MB dikurangi MD</code>.
            </div>

            <div class="d-flex justify-content-end gap-2 mt-3">
                
                {{-- MENGGUNAKAN @if UNTUK TOMBOL BATAL --}}
                <a href="
                    @if(auth()->user()->role === 'admin')
                        {{ route('admin.pengetahuan.index') }}
                    @else
                        {{ route('pakar.pengetahuan.index') }}
                    @endif
                " class="btn btn-light px-4">Batal</a>

                <button type="submit" class="btn btn-success px-4">Simpan Data</button>
            </div>
        </form>
    </div>
@endsection