<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RiwayatKonsultasi;

class RiwayatController extends Controller
{
    public function index()
    {
        // Mengambil data riwayat diurutkan dari yang terbaru, dengan pagination (10 data per halaman)
        $riwayats = RiwayatKonsultasi::latest()->paginate(10);
        return view('page.riwayat.index', compact('riwayats'));
    }
}
