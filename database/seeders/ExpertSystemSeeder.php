<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Penyakit;
use App\Models\Gejala;
use App\Models\BasisPengetahuan;

class ExpertSystemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
public function run(): void
    {
        // 1. Seed Data Penyakit (KP01 - KP06)
        $penyakits = [
            ['kode_penyakit' => 'KP01', 'nama_penyakit' => 'Helmintiasis (Cacingan)'],
            ['kode_penyakit' => 'KP02', 'nama_penyakit' => 'BEF (Bovine Ephemeral Fever)'],
            ['kode_penyakit' => 'KP03', 'nama_penyakit' => 'Scabies'],
            ['kode_penyakit' => 'KP04', 'nama_penyakit' => 'Orf (Ektima Kontagiosa)'],
            ['kode_penyakit' => 'KP05', 'nama_penyakit' => 'Pink Eye'],
            ['kode_penyakit' => 'KP06', 'nama_penyakit' => 'Mastitis'],
        ];

        foreach ($penyakits as $p) {
            Penyakit::create($p);
        }

        // 2. Seed Data Gejala (KG001 - KG025)
        $gejalas = [
            ['kode_gejala' => 'KG001', 'nama_gejala' => 'Tubuh sapi kurus / penurunan berat badan drastis'],
            ['kode_gejala' => 'KG002', 'nama_gejala' => 'Nafsu makan menurun dan terlihat lesu'],
            ['kode_gejala' => 'KG003', 'nama_gejala' => 'Bulu kusam, berdiri, dan kering'],
            ['kode_gejala' => 'KG004', 'nama_gejala' => 'Mengalami diare berulang atau feses menjadi lebih lembek'],
            ['kode_gejala' => 'KG005', 'nama_gejala' => 'Selaput lendir mata tampak pucat (Anemia)'],
            ['kode_gejala' => 'KG006', 'nama_gejala' => 'Demam tinggi mendadak (suhu tubuh naik)'],
            ['kode_gejala' => 'KG007', 'nama_gejala' => 'Kaki gemetar, pincang, atau kaku saat berjalan'],
            ['kode_gejala' => 'KG008', 'nama_gejala' => 'Sapi lebih sering berbaring/ambruk dan enggan bergerak'],
            ['kode_gejala' => 'KG009', 'nama_gejala' => 'Keluar lelehan lendir/nasal dari hidung dan mata berair'],
            ['kode_gejala' => 'KG010', 'nama_gejala' => 'Produksi susu atau nafsu makan turun drastis secara tiba-tiba'],
            ['kode_gejala' => 'KG011', 'nama_gejala' => 'Adanya keropeng hitam/luka melepuh di sekitar bibir dan lubang hidung'],
            ['kode_gejala' => 'KG012', 'nama_gejala' => 'Sapi kesulitan mengunyah makanan atau menolak makan'],
            ['kode_gejala' => 'KG013', 'nama_gejala' => 'Keluar air liur berlebih akibat luka di sekitar mulut'],
            ['kode_gejala' => 'KG014', 'nama_gejala' => 'Sapi sering menggosokkan tubuh ke dinding kandang/tiang (Gatal ekstrem)'],
            ['kode_gejala' => 'KG015', 'nama_gejala' => 'Kerontokan bulu (Alopesia) pada area terinfeksi'],
            ['kode_gejala' => 'KG016', 'nama_gejala' => 'Kulit menebal, berkerak, keras, dan keriput'],
            ['kode_gejala' => 'KG017', 'nama_gejala' => 'Adanya luka lecet atau bentol kemerahan akibat garukan'],
            ['kode_gejala' => 'KG018', 'nama_gejala' => 'Mata berair secara berlebihan (Lakrimasi) dan peka terhadap cahaya'],
            ['kode_gejala' => 'KG019', 'nama_gejala' => 'Selaput mata memerah (Konjungtivitis) dan membengkak'],
            ['kode_gejala' => 'KG020', 'nama_gejala' => 'Bagian tengah mata (Kornea) menjadi keruh, buram, atau berwarna putih'],
            ['kode_gejala' => 'KG021', 'nama_gejala' => 'Sapi sering mengedipkan mata atau menutup mata karena sakit'],
            ['kode_gejala' => 'KG022', 'nama_gejala' => 'Ambing (kantong susu) membengkak, mengeras, merah, atau terasa panas'],
            ['kode_gejala' => 'KG023', 'nama_gejala' => 'Sapi merasa kesakitan atau menendang saat ambingnya disentuh/diperah'],
            ['kode_gejala' => 'KG024', 'nama_gejala' => 'Susu berubah warna (kekuningan/kemerahan) atau pecah dan menggumpal'],
            ['kode_gejala' => 'KG025', 'nama_gejala' => 'Produksi susu menurun drastis'],
        ];

        foreach ($gejalas as $g) {
            Gejala::create($g);
        }

        // 3. Seed Basis Pengetahuan (Rule & Nilai CF Pakar dari Tabel 4.5 Skripsi)
        $rules = [
            // Helmintiasis (KP01)
            ['kp' => 'KP01', 'kg' => 'KG001', 'cf' => 0.6],
            ['kp' => 'KP01', 'kg' => 'KG002', 'cf' => 0.4],
            ['kp' => 'KP01', 'kg' => 'KG003', 'cf' => 0.4],
            ['kp' => 'KP01', 'kg' => 'KG004', 'cf' => 0.8],
            ['kp' => 'KP01', 'kg' => 'KG005', 'cf' => 0.6],
            
            // BEF (KP02)
            ['kp' => 'KP02', 'kg' => 'KG006', 'cf' => 0.8],
            ['kp' => 'KP02', 'kg' => 'KG007', 'cf' => 0.8],
            ['kp' => 'KP02', 'kg' => 'KG008', 'cf' => 0.8],
            ['kp' => 'KP02', 'kg' => 'KG009', 'cf' => 0.6],
            ['kp' => 'KP02', 'kg' => 'KG010', 'cf' => 0.4],

            // Orf (KP04 di skripsi kamu / KP03 secara urutan rule)
            ['kp' => 'KP04', 'kg' => 'KG011', 'cf' => 1.0],
            ['kp' => 'KP04', 'kg' => 'KG012', 'cf' => 0.8],
            ['kp' => 'KP04', 'kg' => 'KG013', 'cf' => 0.6],

            // Scabies (KP03)
            ['kp' => 'KP03', 'kg' => 'KG014', 'cf' => 0.6],
            ['kp' => 'KP03', 'kg' => 'KG015', 'cf' => 0.6],
            ['kp' => 'KP03', 'kg' => 'KG016', 'cf' => 1.0],
            ['kp' => 'KP03', 'kg' => 'KG017', 'cf' => 0.4],

            // Pink Eye (KP05)
            ['kp' => 'KP05', 'kg' => 'KG018', 'cf' => 0.6],
            ['kp' => 'KP05', 'kg' => 'KG019', 'cf' => 1.0],
            ['kp' => 'KP05', 'kg' => 'KG020', 'cf' => 0.8],
            ['kp' => 'KP05', 'kg' => 'KG021', 'cf' => 0.8],

            // Mastitis (KP06)
            ['kp' => 'KP06', 'kg' => 'KG022', 'cf' => 1.0],
            ['kp' => 'KP06', 'kg' => 'KG023', 'cf' => 0.8],
            ['kp' => 'KP06', 'kg' => 'KG024', 'cf' => 1.0],
            ['kp' => 'KP06', 'kg' => 'KG025', 'cf' => 0.4],
        ];

        foreach ($rules as $r) {
            $penyakit = Penyakit::where('kode_penyakit', $r['kp'])->first();
            $gejala = Gejala::where('kode_gejala', $r['kg'])->first();

            if ($penyakit && $gejala) {
                BasisPengetahuan::create([
                    'penyakit_id' => $penyakit->id,
                    'gejala_id' => $gejala->id,
                    'cf_pakar' => $r['cf'],
                ]);
            }
        }
    }
}
