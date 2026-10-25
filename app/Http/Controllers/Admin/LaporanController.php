<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RiwayatKonsultasi;

class LaporanController extends Controller
{
    // Menampilkan halaman utama laporan dengan opsi filter tanggal
    public function index(Request $request)
    {
        $query = RiwayatKonsultasi::latest();

        // Jika admin memfilter berdasarkan tanggal mulai dan selesai
        if ($request->has('tanggal_mulai') && $request->has('tanggal_selesai')) {
            $mulai = $request->tanggal_mulai;
            $selesai = $request->tanggal_selesai;

            if (!empty($mulai) && !empty($selesai)) {
                $query->whereBetween('created_at', [$mulai . ' 00:00:00', $selesai . ' 23:59:59']);
            }
        }

        $laporans = $query->get();

        return view('page.laporan.index', compact('laporans'));
    }

    // Fungsi khusus untuk cetak laporan
    public function cetak(Request $request)
    {
        $query = RiwayatKonsultasi::latest();

        // Inisialisasi awal variabel kosong untuk mencegah eror
        $mulai = null;
        $selesai = null;

        if ($request->has('tanggal_mulai') && $request->has('tanggal_selesai')) {
            $mulai = $request->tanggal_mulai;
            $selesai = $request->tanggal_selesai;

            if (!empty($mulai) && !empty($selesai)) {
                $query->whereBetween('created_at', [$mulai . ' 00:00:00', $selesai . ' 23:59:59']);
            }
        }

        $laporans = $query->get();

        return view('page.laporan.cetak', compact('laporans', 'mulai', 'selesai'));
    }
}