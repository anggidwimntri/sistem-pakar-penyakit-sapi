<?php

namespace App\Http\Controllers\Pakar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RiwayatKonsultasi;

class RiwayatController extends Controller
{
    // Menampilkan seluruh daftar riwayat konsultasi
    public function index()
    {
        // Mengambil data riwayat diurutkan dari yang terbaru, dengan pagination (10 data per halaman)
        $riwayats = RiwayatKonsultasi::latest()->paginate(10);
        return view('page.riwayat.index', compact('riwayats'));
    }

    // Menampilkan detail lengkap dari suatu riwayat cek
    public function show($id)
    {
            $riwayat = RiwayatKonsultasi::findOrFail($id);

            // Ambil data mentah dari kolom gejala_dipilih
            $rawGejala = json_decode($riwayat->gejala_dipilih, true) ?? [];
            
            $gejalaDataMap = []; // Format nanti: [id_gejala => bobot]

            if (!empty($rawGejala)) {
                // Cek apakah format lama (indexed array: [1, 2, 3]) atau format baru (asosiatif: {1: "1.0"})
                if (array_keys($rawGejala) === range(0, count($rawGejala) - 1)) {
                    // Format LAMA: berikan default bobot '1.0' (Pasti 100%)
                    foreach ($rawGejala as $idGejala) {
                        $gejalaDataMap[$idGejala] = '1.0';
                    }
                } else {
                    // Format BARU: ambil sesuai key-value aslinya [id => bobot]
                    $gejalaDataMap = $rawGejala;
                }
            }

            // Ambil data gejala dari database berdasarkan ID yang ada
            $gejalaTerpilih = \App\Models\Gejala::whereIn('id', array_keys($gejalaDataMap))->get();

            // Kirim variabel tambahan ke view
            return view('page.riwayat.detail-page', compact('riwayat', 'gejalaTerpilih', 'gejalaDataMap'));
    }

    // Menghapus data riwayat (opsional jika admin ingin membersihkan data)
    public function destroy($id)
    {
        $riwayat = RiwayatKonsultasi::findOrFail($id);
        $riwayat->delete();

        return redirect()->route('pakar.riwayat.index')->with('success', 'Riwayat konsultasi berhasil dihapus.');
    }
}