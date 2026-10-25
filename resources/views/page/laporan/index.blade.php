@extends('layouts.app-portal')

@section('title', 'Laporan - Sistem Pakar')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="page-title">Laporan Konsultasi</h2>
            <p class="page-subtitle mb-0">Rekapitulasi data hasil diagnosa sistem pakar kesehatan sapi.</p>
        </div>
        <!-- Tombol Cetak / Print (Membuka tab baru) -->
        <a href="{{ route('admin.laporan.cetak', request()->all()) }}" target="_blank" class="btn btn-dark fw-semibold px-3 py-2">
            <i class="bi bi-printer me-1"></i> Cetak Laporan
        </a>
    </div>

    <!-- Kotak Filter Tanggal -->
    <div class="card border-0 shadow-sm p-4 mb-4" style="border-radius: 15px;">
        <form action="{{ route('admin.laporan.index') }}" method="GET" class="row g-3 align-items-end">
            <div class="col-md-4">
                <label class="form-label fw-bold small">Dari Tanggal</label>
                <input type="date" name="tanggal_mulai" class="form-control" value="{{ request('tanggal_mulai') }}">
            </div>
            <div class="col-md-4">
                <label class="form-label fw-bold small">Sampai Tanggal</label>
                <input type="date" name="tanggal_selesai" class="form-control" value="{{ request('tanggal_selesai') }}">
            </div>
            <div class="col-md-4 d-flex gap-2">
                <button type="submit" class="btn btn-success flex-grow-1 fw-semibold">
                    <i class="bi bi-filter me-1"></i> Filter
                </button>
                <a href="{{ route('admin.laporan.index') }}" class="btn btn-light border px-3" title="Reset Filter">
                    <i class="bi bi-arrow-counterclockwise"></i>
                </a>
            </div>
        </form>
    </div>

    <!-- Tabel Data Laporan -->
    <div class="table-custom">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th width="5%">NO</th>
                    <th width="20%">TANGGAL</th>
                    <th width="20%">PETERNAK</th>
                    <th width="25%">PENYAKIT TERDETEKSI</th>
                    <th width="15%" class="text-center">PERSENTASE</th>
                    <th width="15%">ALAMAT</th>
                </tr>
            </thead>
            <tbody>
                @forelse($laporans as $index => $item)
                    <tr>
                        <td class="fw-bold text-muted">{{ $index + 1 }}</td>
                        <td class="text-muted small">{{ $item->created_at->format('d/m/Y H:i') }}</td>
                        <td class="fw-semibold text-dark">{{ $item->nama_peternak }}</td>
                        <td>
                            <span class="badge bg-danger bg-opacity-10 text-danger px-3 py-2 rounded-pill">
                                {{ $item->penyakit_terdeteksi }}
                            </span>
                        </td>
                        <td class="text-center fw-bold text-success">{{ number_format($item->persentase_cf, 2) }}%</td>
                        <td class="text-muted small">{{ $item->alamat }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">
                            Tidak ada data laporan pada rentang tanggal tersebut.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection