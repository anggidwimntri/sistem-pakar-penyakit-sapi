@extends('layouts.app-portal')

@section('content')
<div class="mb-4">
    <h2 class="page-title">Edit Artikel Penyakit</h2>
    <p class="page-subtitle mb-0">Perbarui informasi, penanganan, atau gambar penyakit.</p>
</div>

<div class="card border-0 shadow-sm p-4" style="border-radius: 15px;">
    <form action="{{ route('admin.artikel.update', $artikel->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label fw-bold">Pilih Penyakit</label>
            <select name="penyakit_id" class="form-select" required>
                @foreach($penyakits as $p)
                    <option value="{{ $p->id }}" {{ $artikel->penyakit_id == $p->id ? 'selected' : '' }}>
                        [{{ $p->kode_penyakit }}] {{ $p->nama_penyakit }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Penjelasan Lengkap</label>
            <textarea name="konten_lengkap" class="form-control" rows="5" required>{{ $artikel->konten_lengkap }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Cara Penanganan</label>
            <textarea name="penanganan" class="form-control" rows="3" required>{{ $artikel->penanganan }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Gambar Ilustrasi Saat Ini</label>
            <div class="mb-2">
                @if($artikel->gambar)
                    <img src="{{ asset('storage/' . $artikel->gambar) }}" alt="Preview" class="rounded" style="max-height: 120px; object-fit: cover;">
                @else
                    <span class="text-muted small fst-italic">Belum ada gambar diunggah.</span>
                @endif
            </div>
            <input type="file" name="gambar" class="form-control">
            <small class="text-muted">Biarkan kosong jika tidak ingin mengubah gambar.</small>
        </div>

        <div class="d-flex justify-content-end gap-2 mt-4">
            <a href="{{ route('admin.artikel.index') }}" class="btn btn-light px-4">Batal</a>
            <button type="submit" class="btn btn-success px-4">Simpan Perubahan</button>
        </div>
    </form>
</div>
@endsection