<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gejala;
use App\Models\RiwayatKonsultasi;
use App\Services\DiagnosisService;
use App\Models\User;
use App\Models\Artikel;
use Illuminate\Support\Facades\Auth;

class ConsultationController extends Controller
{
    protected $diagnosisService;

    // Menyambungkan controller dengan logika algoritma di DiagnosisService
    public function __construct(DiagnosisService $diagnosisService)
    {
        $this->diagnosisService = $diagnosisService;
    }

    // 1. Method untuk MENAMPILKAN halaman form konsultasi (Dijalankan saat tombol "Mulai Konsultasi" diklik)
    public function index()
    {
        // Mengambil seluruh data gejala dari database untuk ditampilkan sebagai checklist
        $gejalas = Gejala::all();
        
        // Memanggil file resources/views/konsultasi/form.blade.php
        return view('konsultasi.form', compact('gejalas'));
    }

public function process(Request $request)
    {
        // 1. Validasi inputan utama
        $request->validate([
            'nama_peternak' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'gejala' => 'required|array|min:1',
        ], [
            'gejala.required' => 'Pilih minimal satu gejala klinis yang dialami sapi!',
        ]);

        $selectedGejalaIds = array_keys($request->gejala);
        $userWeights = $request->weights;

        // 2. Cek apakah setiap gejala yang dicentang sudah dipilih tingkat keyakinannya
        foreach ($selectedGejalaIds as $gejalaId) {
            if (!isset($userWeights[$gejalaId]) || $userWeights[$gejalaId] === '') {
                return back()->withInput()->with('error', 'Harap pilih tingkat keyakinan untuk setiap gejala yang Anda centang!');
            }
        }

        // 3. Eksekusi diagnosis via Service
        $results = $this->diagnosisService->diagnose($selectedGejalaIds, $userWeights);

        if (empty($results)) {
            return back()->with('error', 'Gejala yang dipilih tidak cocok dengan basis pengetahuan penyakit manapun.');
        }

        // Ambil hasil teratas
        $topResult = $results[0];

        // --- 👇 PERUBAHAN ADA DI BAGIAN INI 👇 ---
        // Gabungkan ID gejala dan bobot user menjadi format asosiatif [id_gejala => bobot]
        $gejalaDanBobot = [];
        foreach ($selectedGejalaIds as $id) {
            $gejalaDanBobot[$id] = $userWeights[$id] ?? '1.0';
        }

        // Simpan ke database Riwayat Konsultasi
        $riwayat = RiwayatKonsultasi::create([
            'user_id' => Auth::id(),
            'nama_peternak' => $request->nama_peternak,
            'alamat' => $request->alamat,
            'penyakit_terdeteksi' => $topResult['penyakit']->nama_penyakit,
            'persentase_cf' => $topResult['cf_score'],
            'probabilitas_nb' => $topResult['nb_score'],
            'gejala_dipilih' => json_encode($gejalaDanBobot), // Sekarang menyimpan format [id => bobot] secara lengkap!
        ]);
        // ----------------------------------------

        // AMBIL DATA GEJALA YANG DIPILIH DARI DATABASE AGAR BISA DITAMPILKAN DI VIEW
        $gejalaDipilih = \App\Models\Gejala::whereIn('id', $selectedGejalaIds)->get();

        // Data yang dikirim ke view
        $viewData = [
            'riwayat' => $riwayat,
            'topResult' => $topResult,
            'allResults' => $results,
            'gejalaDipilih' => $gejalaDipilih, 
        ];

        // CEK: Jika user sedang login (mengakses dari portal), arahkan ke view hasil portal
        if (auth()->check()) {
            return view('konsultasi.hasil-portal', $viewData);
        }

        // Jika dari halaman umum (belum login), arahkan ke view hasil publik
        return view('konsultasi.hasil', $viewData);
    }
    
    public function konsultasi()
    {
        // Mengambil seluruh data gejala dari database untuk ditampilkan sebagai checklist
        $gejalas = Gejala::all();
        
        // Memanggil file resources/views/konsultasi/form.blade.php
        return view('konsultasi.form-portal', compact('gejalas'));
    }

    public function riwayatSaya()
    {
    // Mengambil data riwayat berdasarkan ID user yang sedang login saja, diurutkan dari yang terbaru
    $riwayats = RiwayatKonsultasi::where('user_id', Auth::id())
                    ->latest()
                    ->get();

    return view('page.riwayat.saya', compact('riwayats'));
    }

    //Hasil Detail Page
    public function detailPublik($id)
    {
        // 1. Ambil data riwayat berdasarkan ID
        $riwayat = \App\Models\RiwayatKonsultasi::findOrFail($id);

        // 2. Ambil data Penyakit beserta relasi artikelnya
        $penyakit = \App\Models\Penyakit::with('artikel')
                    ->where('nama_penyakit', $riwayat->penyakit_terdeteksi)
                    ->first();

        // 3. Olah data gejala (Mendukung data JSON format LAMA maupun BARU)
        $rawGejala = json_decode($riwayat->gejala_dipilih, true) ?? [];
        $gejalaDataMap = []; 

        if (!empty($rawGejala)) {
            if (array_keys($rawGejala) === range(0, count($rawGejala) - 1)) {
                // Format lama [1, 2, 3]
                foreach ($rawGejala as $idGejala) {
                    $gejalaDataMap[$idGejala] = '1.0'; 
                }
            } else {
                // Format baru {"1": "1.0", "5": "0.8"}
                $gejalaDataMap = $rawGejala;
            }
        }

        $gejalaTerpilih = \App\Models\Gejala::whereIn('id', array_keys($gejalaDataMap))->get();

        // 4. Kirim data ke view halaman ke-2
        return view('konsultasi.hasil-detail', compact('riwayat', 'penyakit', 'gejalaTerpilih', 'gejalaDataMap'));
    }

    //MENU INFORMASI
    public function penyakit()
    {
        // Ambil artikel beserta relasi penyakitnya
        $artikels = Artikel::with('penyakit')->get();
        return view('informasi.jenis-penyakit', compact('artikels'));
    }

        public function informasi()
    {
        // Ambil artikel beserta relasi penyakitnya
        $artikels = Artikel::with('penyakit')->get();
        return view('informasi.index-user', compact('artikels'));
    }


    public function detailPenyakit($id)
    {
        // Ambil artikel spesifik berdasarkan ID beserta relasi penyakit dan gejala pengetahuan
        $artikel = Artikel::with(['penyakit.pengetahuans.gejala'])->findOrFail($id);
        return view('informasi.detail-penyakit', compact('artikel'));
    }

        public function detailPenyakitUser($id)
    {
        // Ambil artikel spesifik berdasarkan ID beserta relasi penyakit dan gejala pengetahuan
        $artikel = Artikel::with(['penyakit.pengetahuans.gejala'])->findOrFail($id);
        return view('informasi.user-detail-penyakit', compact('artikel'));
    }

    // Menampilkan halaman panduan penggunaan sistem
    public function panduan()
    {
        return view('informasi.cara-penggunaan');
    }
}