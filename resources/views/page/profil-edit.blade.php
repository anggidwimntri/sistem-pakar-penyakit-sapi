@extends('layouts.app-portal')

@section('content')
<div class="mb-4">
    <h2 class="page-title">Profil Saya</h2>
    <p class="page-subtitle mb-0">Kelola informasi akun dan keamanan kata sandi Anda.</p>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="row">
    <!-- Form Edit Informasi Akun -->
    <div class="col-lg-6 mb-4">
        <div class="card border-0 shadow-sm p-4 rounded-4 h-100">
            <h4 class="fw-bold text-dark mb-3">Informasi Akun</h4>
            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label fw-bold">Nama Lengkap</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Alamat Email</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Level Akses (Role)</label>
                    <input type="text" class="form-control text-capitalize bg-light" value="{{ $user->role }}" disabled>
                </div>

                <button type="submit" class="btn btn-success px-4">Simpan Perubahan</button>
            </form>
        </div>
    </div>

    <!-- Form Ganti Password -->
    <div class="col-lg-6 mb-4">
        <div class="card border-0 shadow-sm p-4 rounded-4 h-100">
            <h4 class="fw-bold text-dark mb-3">Ganti Password</h4>
            
            @if(session('success_password'))
                <div class="alert alert-success py-2 small">
                    {{ session('success_password') }}
                </div>
            @endif

            <form action="{{ route('profile.password') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label fw-bold">Password Saat Ini</label>
                    <input type="password" name="current_password" class="form-control @error('current_password') is-invalid @enderror" required>
                    @error('current_password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Password Baru</label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Konfirmasi Password Baru</label>
                    <input type="password" name="password_confirmation" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-dark px-4">Ubah Password</button>
            </form>
        </div>
    </div>
</div>
@endsection