<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Penyakit;
use App\Models\Gejala;
use App\Models\Artikel;
use App\Models\User;
use App\Models\RiwayatKonsultasi;

class DashboardController extends Controller
{
    // Halaman Utama Dashboard
   public function index() {
    $totalPenyakit = Penyakit::count();
    $totalGejala = Gejala::count();
    $totalKonsultasi = RiwayatKonsultasi::count(); // sesuaikan nama model riwayatmu
    $totalArtikel = Artikel::count();
    $totalUsers = User::count(); // Total pengguna terdaftar
    $riwayats = RiwayatKonsultasi::latest()->take(5)->get(); // ambil 5 riwayat terbaru
// 1. Data untuk Chart Garis (Tren Bulanan)
    $chartData = RiwayatKonsultasi::select(
            DB::raw('COUNT(*) as total'),
            DB::raw('MONTH(created_at) as bulan')
        )
        ->whereYear('created_at', date('Y'))
        ->groupBy('bulan')
        ->orderBy('bulan')
        ->pluck('total', 'bulan')
        ->toArray();

    $monthlyData = [];
    for ($i = 1; $i <= 12; $i++) {
        $monthlyData[] = $chartData[$i] ?? 0;
    }

    // 2. Data untuk Chart Penyakit Terbanyak (Distribusi Penyakit)
    // Mengelompokkan berdasarkan nama penyakit yang terdeteksi di riwayat
    $penyakitStats = RiwayatKonsultasi::select('penyakit_terdeteksi', DB::raw('count(*) as total'))
        ->groupBy('penyakit_terdeteksi')
        ->orderByDesc('total')
        ->get();

    $penyakitLabels = $penyakitStats->pluck('penyakit_terdeteksi');
    $penyakitCounts = $penyakitStats->pluck('total');

    return view('page.dashboard.admin', compact(
        'totalPenyakit', 'totalGejala', 'totalKonsultasi', 'totalArtikel', 'totalUsers', 
        'riwayats', 'monthlyData', 'penyakitLabels', 'penyakitCounts'
    ));
}
}