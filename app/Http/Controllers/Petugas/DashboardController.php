<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Penyakit;
use App\Models\Gejala;
use App\Models\RiwayatKonsultasi;

class DashboardController extends Controller
{
    // Halaman Utama Dashboard
   public function index() 
{
    $totalPenyakit = Penyakit::count();
    $totalGejala = Gejala::count();
    $totalKonsultasi = RiwayatKonsultasi::count();
    $riwayats = RiwayatKonsultasi::latest()->take(5)->get();

    return view('page.dashboard.petugas', compact(
        'totalPenyakit', 
        'totalGejala', 
        'totalKonsultasi', 
        'riwayats'
    ));
}
    
}
