@extends('layouts.app-portal')

@section('title', 'Edit Basis Pengetahuan')

@section('content')
    <div class="mb-4">
        <h2 class="page-title">Edit Basis Pengetahuan (CF)</h2>
        <p class="page-subtitle mb-0">Perbarui nilai MB dan MD pakar.</p>
    </div>

    <div class="card border-0 shadow-sm p-4" style="border-radius: 15px;">
        <form action="
            @if(auth()->user()->role === 'admin')
                {{ route('admin.pengetahuan.update', $pengetahuan->id) }}
            @else
                {{ route('pakar.pengetahuan.update', $pengetahuan->id) }}
            @endif
        " method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label class="form-label fw-bold">Pilih Penyakit</label>
                <select name="penyakit_id" class="form-select" required>
                    @foreach($penyakits as $p)
                        <option value="{{ $p->id }}" {{ $pengetahuan->penyakit_id == $p->id ? 'selected' : '' }}>
                            [{{ $p->kode_penyakit }}] {{ $p->nama_penyakit }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Pilih Gejala</label>
                <select name="gejala_id" class="form-select" required>
                    @foreach($gejalas as $g)
                        <option value="{{ $g->id }}" {{ $pengetahuan->gejala_id == $g->id ? 'selected' : '' }}>
                            [{{ $g->kode_gejala }}] {{ $g->nama_gejala }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Nilai MB</label>
                    <input type="number" step="0.1" min="0" max="1" name="mb" class="form-control" value="{{ $pengetahuan->mb }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Nilai MD</label>
                    <input type="number" step="0.1" min="0" max="1" name="md" class="form-control" value="{{ $pengetahuan->md }}" required>
                </div>
            </div>

            <div class="d-flex justify-content-end gap-2 mt-3">
                <a href="
                    @if(auth()->user()->role === 'admin')
                        {{ route('admin.pengetahuan.index') }}
                    @else
                        {{ route('pakar.pengetahuan.index') }}
                    @endif
                        " class="btn btn-light px-4">Batal</a>
                <button type="submit" class="btn btn-success px-4">Simpan Perubahan</button>
            </div>
        </form>
    </div>
@endsection