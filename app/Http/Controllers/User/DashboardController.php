<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Penyakit;
use App\Models\Gejala;
use App\Models\RiwayatKonsultasi;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // Hitung total riwayat khusus user yang sedang login
        $totalRiwayatSaya = RiwayatKonsultasi::where('user_id', $userId)->count(); // sesuaikan kolom relasi user di tabel riwayats jika ada
        $totalPenyakit = Penyakit::count();

        // Ambil 5 riwayat terbaru milik user ini saja
        $riwayats = RiwayatKonsultasi::where('user_id', $userId)->latest()->take(5)->get();

        return view('page.dashboard.user', compact('totalRiwayatSaya', 'totalPenyakit', 'riwayats'));
    }
}
