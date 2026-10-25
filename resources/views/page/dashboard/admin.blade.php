@extends('layouts.app-portal')

@section('content')
    <!-- Header Sambutan & Quick Actions -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 pb-3 border-bottom">
        <div>
            <h2 class="page-title fw-bold text-dark">Ringkasan Sistem</h2>
            <p class="page-subtitle text-muted mb-0">Selamat datang kembali, Administrator. Berikut adalah status terkini dari Sistem Pakar Kesehatan Ternak Sapi Aceh Utara.</p>
        </div>
        <div class="mt-3 mt-md-0 d-flex gap-2">
            <a href="{{ route('admin.pengetahuan.index') }}" class="btn btn-success btn-sm rounded-pill px-3 shadow-sm">
                <i class="bi bi-diagram-3 me-1"></i> Atur Rule CF
            </a>
            <a href="{{ route('admin.artikel.create') }}" class="btn btn-outline-success btn-sm rounded-pill px-3">
                <i class="bi bi-journal-plus me-1"></i> Buat Artikel
            </a>
        </div>
    </div>

    <!-- Cards Row (5 Statistik Sekarang) -->
    <div class="row g-4 mb-4">
        <!-- Card 1: Penyakit -->
        <div class="col-sm-6 col-xl">
            <div class="card-stat border-0 shadow-sm p-3 rounded-4 bg-white h-100">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="stat-label-top text-uppercase fw-bold text-muted" style="font-size: 11px;">Database</span>
                    <div class="bg-success bg-opacity-10 text-success p-2 rounded-3"><i class="bi bi-bug-fill"></i></div>
                </div>
                <h4 class="fw-bold mb-0">{{ $totalPenyakit ?? 0 }}</h4>
                <small class="text-muted" style="font-size: 12px;">Penyakit Terdata</small>
            </div>
        </div>
        
        <!-- Card 2: Gejala -->
        <div class="col-sm-6 col-xl">
            <div class="card-stat border-0 shadow-sm p-3 rounded-4 bg-white h-100">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="stat-label-top text-uppercase fw-bold text-muted" style="font-size: 11px;">Variabel</span>
                    <div class="bg-primary bg-opacity-10 text-primary p-2 rounded-3"><i class="bi bi-ui-checks"></i></div>
                </div>
                <h4 class="fw-bold mb-0">{{ $totalGejala ?? 0 }}</h4>
                <small class="text-muted" style="font-size: 12px;">Gejala Klinis</small>
            </div>
        </div>

        <!-- Card 3: Konsultasi -->
        <div class="col-sm-6 col-xl">
            <div class="card-stat border-0 shadow-sm p-3 rounded-4 bg-white h-100">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="stat-label-top text-uppercase fw-bold text-muted" style="font-size: 11px;">Aktivitas</span>
                    <div class="bg-warning bg-opacity-10 text-warning p-2 rounded-3"><i class="bi bi-people-fill"></i></div>
                </div>
                <h4 class="fw-bold mb-0">{{ $totalKonsultasi ?? 0 }}</h4>
                <small class="text-muted" style="font-size: 12px;">Total Konsultasi</small>
            </div>
        </div>

        <!-- Card 4: Artikel Edukasi -->
        <div class="col-sm-6 col-xl">
            <div class="card-stat border-0 shadow-sm p-3 rounded-4 bg-white h-100">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="stat-label-top text-uppercase fw-bold text-muted" style="font-size: 11px;">Edukasi</span>
                    <div class="bg-info bg-opacity-10 text-info p-2 rounded-3"><i class="bi bi-journal-text"></i></div>
                </div>
                <h4 class="fw-bold mb-0">{{ $totalArtikel ?? 0 }}</h4>
                <small class="text-muted" style="font-size: 12px;">Artikel Terbit</small>
            </div>
        </div>

        <!-- Card 5: Total Pengguna Terdaftar -->
        <div class="col-sm-6 col-xl">
            <div class="card-stat border-0 shadow-sm p-3 rounded-4 bg-white h-100">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="stat-label-top text-uppercase fw-bold text-muted" style="font-size: 11px;">Pengguna</span>
                    <div class="bg-danger bg-opacity-10 text-danger p-2 rounded-3"><i class="bi bi-person-badge"></i></div>
                </div>
                <h4 class="fw-bold mb-0">{{ $totalUsers ?? 0 }}</h4>
                <small class="text-muted" style="font-size: 12px;">User Terdaftar</small>
            </div>
        </div>
    </div>

    <!-- 2 Grafik Berdampingan (Tren Konsultasi & Statistik Penyakit Terbanyak) -->
    <div class="row mb-4">
        <!-- Grafik Tren Bulanan -->
        <div class="col-lg-7 mb-4 mb-lg-0">
            <div class="card border-0 shadow-sm rounded-4 p-4 h-100">
                <h5 class="fw-bold text-dark mb-3"><i class="bi bi-graph-up-arrow text-success me-2"></i>Tren Konsultasi Bulanan ({{ date('Y') }})</h5>
                <div style="height: 280px;">
                    <canvas id="konsultasiChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Grafik Penyakit Terbanyak -->
        <div class="col-lg-5">
            <div class="card border-0 shadow-sm rounded-4 p-4 h-100">
                <h5 class="fw-bold text-dark mb-3"><i class="bi bi-pie-chart-fill text-success me-2"></i>Penyakit Sering Didiagnosa</h5>
                <div style="height: 280px;" class="d-flex justify-content-center align-items-center">
                    <canvas id="penyakitChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Table Section: Riwayat Terbaru -->
    <div class="card border-0 shadow-sm rounded-4 p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="fw-bold text-dark mb-0">Riwayat Konsultasi Terbaru</h5>
            <a href="{{ route('admin.riwayat.index') }}" class="btn btn-sm btn-outline-success rounded-pill px-3">
                Lihat Semua <i class="bi bi-arrow-right ms-1"></i>
            </a>
        </div>

        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead class="table-light text-uppercase fs-7">
                    <tr>
                        <th class="py-3">Peternak</th>
                        <th class="py-3">Alamat</th>
                        <th class="py-3">Penyakit Terdeteksi</th>
                        <th class="py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($riwayats as $r)
                        <tr>
                            <td class="fw-semibold py-3">{{ $r->nama_peternak }}</td>
                            <td class="text-muted py-3">{{ $r->alamat }}</td>
                            <td class="py-3">
                                <span class="badge bg-danger bg-opacity-10 text-danger px-3 py-2 rounded-pill fw-bold">
                                    {{ $r->penyakit_terdeteksi }}
                                </span>
                            </td>
                            <td class="text-center py-3">
                                <a href="{{ route('admin.riwayat.detail', $r->id) }}" class="btn btn-sm btn-light text-success border" title="Lihat Detail">
                                    <i class="bi bi-eye"></i> Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-5">
                                <i class="bi bi-inbox display-4 d-block mb-2 text-secondary opacity-50"></i>
                                Belum ada data riwayat konsultasi yang tercatat di sistem.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- SCRIPT CHART.JS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // 1. Script Chart Garis (Tren Konsultasi)
        const ctxLine = document.getElementById('konsultasiChart').getContext('2d');
        new Chart(ctxLine, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agt', 'Sep', 'Okt', 'Nov', 'Des'],
                datasets: [{
                    label: 'Jumlah Konsultasi',
                    data: @json($monthlyData),
                    backgroundColor: 'rgba(26, 77, 46, 0.1)',
                    borderColor: '#1a4d2e',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.3,
                    pointBackgroundColor: '#1a4d2e'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: { beginAtZero: true, ticks: { stepSize: 1 } }
                }
            }
        });

        // 2. Script Chart Donat (Penyakit Terbanyak)
        const ctxPie = document.getElementById('penyakitChart').getContext('2d');
        new Chart(ctxPie, {
            type: 'doughnut',
            data: {
                labels: @json($penyakitLabels),
                datasets: [{
                    data: @json($penyakitCounts),
                    backgroundColor: [
                        '#1a4d2e', '#2b5329', '#4d7c0f', '#15803d', '#166534', '#065f46'
                    ],
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: { boxWidth: 12, font: { size: 11 } }
                    }
                }
            }
        });
    </script>
@endsection