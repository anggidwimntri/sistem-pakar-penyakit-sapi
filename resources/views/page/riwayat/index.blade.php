@extends('layouts.app-portal')

@section('title', 'Riwayat Cek - Sistem Pakar')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="page-title">Riwayat Cek (Konsultasi)</h2>
            <p class="page-subtitle mb-0">Daftar rekapitulasi hasil diagnosa kesehatan ternak sapi oleh peternak.</p>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="table-custom">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th width="5%">NO</th>
                    <th width="20%">PETERNAK</th>
                    <th width="25%">ALAMAT</th>
                    <th width="25%">PENYAKIT TERDETEKSI</th>
                    <th width="15%" class="text-center">PERSENTASE</th>
                    <th width="10%" class="text-center">AKSI</th>
                </tr>
            </thead>
            <tbody>
                @forelse($riwayats as $index => $r)
                    <tr>
                        <td class="fw-bold text-muted">{{ $riwayats->firstItem() + $index }}</td>
                        <td class="fw-semibold text-dark">{{ $r->nama_peternak }}</td>
                        <td class="text-muted">{{ $r->alamat }}</td>
                        <td>
                            <span class="badge bg-danger bg-opacity-10 text-danger px-3 py-2 rounded-pill">
                                {{ $r->penyakit_terdeteksi }}
                            </span>
                        </td>
                        <td class="text-center">
                            <div class="fw-bold text-success">CF: {{ number_format($r->persentase_cf, 2) }}%</div>
                            <div class="small text-muted">NB: {{ number_format($r->probabilitas_nb, 2) }}%</div>
                        </td>
                        <td class="text-center">
                            {{-- TOMBOL DETAIL DINAMIS --}}
                            <a href="
                                @if(auth()->user()->role === 'admin')
                                    {{ route('admin.riwayat.detail', $r->id) }}
                                @else
                                    {{ route('pakar.riwayat.detail', $r->id) }}
                                @endif
                            " class="btn btn-sm btn-light text-primary me-1" title="Lihat Detail">
                                <i class="bi bi-eye"></i>
                            </a>

                            {{-- TOMBOL HAPUS DINAMIS --}}
                            <form action="
                                @if(auth()->user()->role === 'admin')
                                    {{ route('admin.riwayat.destroy', $r->id) }}
                                @else
                                    {{ route('pakar.riwayat.destroy', $r->id) }}
                                @endif
                                " method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus riwayat ini?')">
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
                        <td colspan="6" class="text-center text-muted py-4">
                            Belum ada riwayat konsultasi yang tercatat di sistem.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Navigasi Pagination -->
    <div class="mt-4 d-flex justify-content-center">
    {{ $riwayats->links('pagination::bootstrap-5') }}
</div>
@endsection