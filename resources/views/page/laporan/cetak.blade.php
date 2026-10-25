<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Laporan Konsultasi - Sistem Pakar Sapi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #ffffff; color: #000; font-family: Arial, sans-serif; }
        .header-laporan { text-align: center; border-bottom: 3px double #000; padding-bottom: 15px; margin-bottom: 25px; }
        @media print {
            .no-print { display: none; }
        }
    </style>
</head>
<body onload="window.print()">

    <div class="container mt-4">
        <!-- Tombol Kembali (Hilang saat diprint) -->
        <div class="mb-3 no-print">
            <button onclick="window.close()" class="btn btn-secondary btn-sm">Tutup Halaman</button>
        </div>

        <div class="header-laporan">
            <h4>DINAS PERKEBUNAN, PETERNAKAN DAN KESEHATAN HEWAN</h4>
            <h5>LAPORAN HASIL KONSULTASI KESEHATAN TERNAK SAPI</h5>
            <p class="mb-0 text-muted small">Kabupaten Aceh Utara</p>
        </div>

        @if(isset($mulai) && isset($selesai) && !empty($mulai) && !empty($selesai))
            <p class="mb-3"><strong>Periode:</strong> {{ $mulai }} s/d {{ $selesai }}</p>
        @else
            <p class="mb-3"><strong>Periode:</strong> Seluruh Waktu</p>
        @endif

        <table class="table table-bordered border-dark align-middle">
            <thead class="table-light text-center">
                <tr>
                    <th>NO</th>
                    <th>TANGGAL</th>
                    <th>PETERNAK</th>
                    <th>ALAMAT</th>
                    <th>PENYAKIT TERDETEKSI</th>
                    <th>PERSENTASE (CF)</th>
                </tr>
            </thead>
            <tbody>
                @forelse($laporans as $index => $item)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td>{{ $item->created_at->format('d-m-Y H:i') }}</td>
                        <td class="fw-semibold">{{ $item->nama_peternak }}</td>
                        <td>{{ $item->alamat }}</td>
                        <td>{{ $item->penyakit_terdeteksi }}</td>
                        <td class="text-center fw-bold">{{ number_format($item->persentase_cf, 2) }}%</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-3">Belum ada data laporan konsultasi.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Tanda Tangan Pengesahan -->
        <div class="row mt-5">
            <div class="col-8"></div>
            <div class="col-4 text-center">
                <p class="mb-1">Aceh Utara, {{ date('d F Y') }}</p>
                <p>Mengetahui,</p>
                <br><br><br>
                <p class="fw-bold mb-0"><u>Administrator Dinas</u></p>
                <p class="text-muted small">NIP. 19800101 200501 1 001</p>
            </div>
        </div>
    </div>

</body>
</html>