@extends('layouts.app-portal')

@section('title', 'Kelola Pengguna - Sistem Pakar')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="page-title">Kelola Pengguna</h2>
            <p class="page-subtitle mb-0">Kelola data akun serta hak akses pengguna di dalam sistem.</p>
        </div>
        <a href="{{ route('admin.users.create') }}" class="btn btn-success fw-semibold px-3 py-2">
            <i class="bi bi-person-plus me-1"></i> Tambah Pengguna
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="table-custom">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th width="5%">NO</th>
                    <th width="30%">NAMA</th>
                    <th width="30%">EMAIL</th>
                    <th width="20%" class="text-center">HAK AKSES (ROLE)</th>
                    <th width="15%" class="text-center">AKSI</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $index => $u)
                    <tr>
                        <td class="fw-bold text-muted">{{ $users->firstItem() + $index }}</td>
                        <td class="fw-semibold text-dark">{{ $u->name }}</td>
                        <td class="text-muted">{{ $u->email }}</td>
                        <td class="text-center">
                            @if($u->role === 'admin')
                                <span class="badge bg-danger px-3 py-2">Admin</span>
                            @elseif($u->role === 'pakar')
                                <span class="badge bg-success px-3 py-2">Pakar</span>
                            @elseif($u->role === 'petugas')
                                <span class="badge bg-primary px-3 py-2">Petugas</span>
                            @else
                                <span class="badge bg-secondary px-3 py-2">Peternak</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('admin.users.edit', $u->id) }}" class="btn btn-sm btn-light text-primary me-1" title="Edit">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <form action="{{ route('admin.users.destroy', $u->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus pengguna ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-light text-danger" title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">
                            Belum ada pengguna terdaftar.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $users->links() }}
    </div>
@endsection