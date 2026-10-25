@extends('layouts.app-portal')

@section('title', 'Riwayat Konsultasi Saya')

@section('content')
    <div class="container py-4">
        
        <!-- Judul Halaman -->
        <div class="text-center mb-5">
            <h1 class="page-title">Riwayat Konsultasi Sapi</h1>
            <p class="text-muted">Daftar riwayat analisis klinis dan hasil diagnosis penyakit menular sapi yang pernah Anda lakukan.</p>
        </div>

        <!-- Alert Jika Belum Ada Riwayat -->
        @if($riwayats->isEmpty())
            <div class="card border-0 shadow-sm rounded-4 text-center py-5">
                <div class="card-body">
                    <i class="bi bi-journal-x text-muted" style="font-size: 3rem;"></i>
                    <h4 class="mt-3 text-secondary">Belum Ada Riwayat Konsultasi</h4>
                    <p class="text-muted mb-4">Anda belum pernah melakukan analisis atau konsultasi penyakit sapi melalui sistem ini.</p>
                    <a href="{{ Auth::user()->role === 'petugas' ? route('petugas.konsultasi') : route('user.konsultasi') }}" class="btn btn-submit px-4 shadow-sm">
                        <i class="bi bi-stethoscope me-2"></i> Mulai Konsultasi Sekarang
                    </a>
                </div>
            </div>
        @else
            <!-- Tabel Daftar Riwayat -->
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light text-uppercase fs-7">
                            <tr>
                                <th class="py-3 px-4">No</th>
                                <th class="py-3">Tanggal</th>
                                <th class="py-3">Nama Peternak</th>
                                <th class="py-3">Penyakit Terdeteksi</th>
                                <th class="py-3 text-center">Tingkat Keyakinan </th>
                                <th class="py-3 text-end px-4">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($riwayats as $index => $r)
                            <tr>
                                <td class="px-4 fw-bold text-muted">{{ $index + 1 }}</td>
                                <td>
                                    <span class="d-block text-dark fw-medium">{{ $r->created_at->format('d M Y') }}</span>
                                    <small class="text-muted">{{ $r->created_at->format('H:i') }} WIB</small>
                                </td>
                                <td>
                                    <span class="d-block text-dark fw-medium">{{ $r->nama_peternak }}</span>
                                    <small class="text-muted">{{ Str::limit($r->alamat, 30) }}</small>
                                </td>
                                <td>
                                    <span class="badge bg-danger-subtle text-danger px-3 py-2 rounded-pill fw-semibold">
                                        {{ $r->penyakit_terdeteksi }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <div class="fw-bold text-success">CF: {{ number_format($r->persentase_cf, 2) }}%</div>
                                    <div class="small text-muted">NB: {{ number_format($r->probabilitas_nb, 2) }}%</div>
                                </td>
                                <td class="text-end px-4">
                                    <!-- Tombol untuk melihat detail hasil riwayat (opsional jika ingin dibuatkan rute detailnya) -->
                                    <a href="
                                @if(auth()->user()->role === 'petugas')
                                    {{ route('petugas.riwayat.detail', $r->id) }}
                                @else
                                    {{ route('user.riwayat.detail', $r->id) }}
                                @endif
                            " class="btn btn-sm btn-light text-primary me-1" title="Lihat Detail">
                                <i class="bi bi-eye"></i>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif

    </div>
@endsection