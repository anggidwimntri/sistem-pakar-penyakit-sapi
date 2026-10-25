<?php

namespace App\Http\Controllers\Pakar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Penyakit;
use App\Models\Gejala;
use App\Models\BasisPengetahuan;
use App\Models\RiwayatKonsultasi;

class DashboardController extends Controller
{
    // Halaman Utama Dashboard
    public function index()
    {
        $totalPenyakit = Penyakit::count();
    $totalKonsultasi = RiwayatKonsultasi::count();
    $totalPengetahuan = BasisPengetahuan::count();
    $totalGejala = Gejala::count(); 
    $riwayats = RiwayatKonsultasi::latest()->take(5)->get();

    return view('page.dashboard.pakar', compact(
        'totalPenyakit', 
        'totalKonsultasi', 
        'totalPengetahuan', 
        'totalGejala',
        'riwayats'
    ));
}

    // Menampilkan seluruh data riwayat (Untuk tombol "Lihat Semua")
    public function semuaRiwayat()
    {
        $riwayats = RiwayatKonsultasi::latest()->paginate(10);
        return view('page.riwayat.index', compact('riwayats'));
    }

    // Menampilkan detail riwayat tertentu (Untuk tombol ikon mata)
    public function detailRiwayat($id)
    {
        $riwayat = RiwayatKonsultasi::findOrFail($id);
        return view('page.riwayat.detail-page', compact('riwayat'));
    }
}
