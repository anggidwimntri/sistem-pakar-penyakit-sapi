@extends('layouts.app-portal')

@section('content')
<div class="card p-4">
    <!-- TAMPILKAN PESAN ERROR VALIDASI -->
    @if ($errors->any())
        <div class="alert alert-danger mb-3">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.artikel.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label>Pilih Penyakit</label>
            <select name="penyakit_id" class="form-select" required>
                <option value="">-- Pilih Penyakit --</option>
                @foreach($penyakits as $p)
                    <option value="{{ $p->id }}" {{ old('penyakit_id') == $p->id ? 'selected' : '' }}>
                        {{ $p->nama_penyakit }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Penjelasan Lengkap</label>
            <textarea name="konten_lengkap" class="form-control" rows="5" required>{{ old('konten_lengkap') }}</textarea>
        </div>
        <div class="mb-3">
            <label>Cara Penanganan</label>
            <textarea name="penanganan" class="form-control" rows="3" required>{{ old('penanganan') }}</textarea>
        </div>
        <div class="mb-3">
            <label>Gambar Ilustrasi</label>
            <input type="file" name="gambar" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Simpan Artikel</button>
    </form>
</div>
@endsection