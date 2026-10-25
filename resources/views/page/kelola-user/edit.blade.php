@extends('layouts.app-portal')

@section('title', 'Edit Pengguna')

@section('content')
    <div class="mb-4">
        <h2 class="page-title">Edit Pengguna</h2>
        <p class="page-subtitle mb-0">Perbarui informasi profil atau perbarui hak akses pengguna.</p>
    </div>

    <div class="card border-0 shadow-sm p-4" style="border-radius: 15px;">
        <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label class="form-label fw-bold">Nama Lengkap</label>
                <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Alamat Email</label>
                <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Password Baru (Opsional)</label>
                <input type="password" name="password" class="form-control" placeholder="Biarkan kosong jika tidak ingin mengubah password">
            </div>

            <div class="mb-4">
                <label class="form-label fw-bold">Hak Akses (Role)</label>
                <select name="role" class="form-select" required>
                    <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="pakar" {{ $user->role === 'pakar' ? 'selected' : '' }}>Pakar (Dokter Hewan)</option>
                    <option value="petugas" {{ $user->role === 'petugas' ? 'selected' : '' }}>Petugas Lapangan</option>
                    <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User / Peternak</option>
                </select>
            </div>

            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('admin.users.index') }}" class="btn btn-light px-4">Batal</a>
                <button type="submit" class="btn btn-success px-4">Simpan Perubahan</button>
            </div>
        </form>
    </div>
@endsection