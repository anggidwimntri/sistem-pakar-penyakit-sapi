@extends('layouts.app-portal')

@section('title', 'Tambah Pengguna')

@section('content')
    <div class="mb-4">
        <h2 class="page-title">Tambah Pengguna Baru</h2>
        <p class="page-subtitle mb-0">Isi formulir berikut untuk mendaftarkan akun baru.</p>
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
                <label class="form-label fw-bold">Nama Lengkap</label>
                <input type="text" name="name" class="form-control" placeholder="Contoh: Drh. Ahmad Supandi" value="{{ old('name') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Alamat Email</label>
                <input type="email" name="email" class="form-control" placeholder="Contoh: ahmad@gmail.com" value="{{ old('email') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Minimal 6 karakter" required>
            </div>

            <div class="mb-4">
                <label class="form-label fw-bold">Pilih Hak Akses (Role)</label>
                <select name="role" class="form-select" required>
                    <option value="" disabled selected>-- Pilih Hak Akses --</option>
                    <option value="admin">Admin</option>
                    <option value="pakar">Pakar (Dokter Hewan)</option>
                    <option value="petugas">Petugas Lapangan</option>
                    <option value="user">User / Peternak</option>
                </select>
            </div>

            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('admin.users.index') }}" class="btn btn-light px-4">Batal</a>
                <button type="submit" class="btn btn-success px-4">Simpan Data</button>
            </div>
        </form>
    </div>
@endsection