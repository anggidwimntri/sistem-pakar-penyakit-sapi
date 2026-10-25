<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatKonsultasi extends Model
{
    use HasFactory;

    // Tambahkan nama tabel jika tidak mengikuti standar bahasa inggris Laravel (opsional tapi disarankan)
    protected $table = 'riwayat_konsultasis'; 

    // WAJIB DITAMBAHKAN: Memberi izin kolom mana saja yang boleh diisi lewat controller
    protected $fillable = [
        'nama_peternak',
        'alamat',
        'penyakit_terdeteksi',
        'persentase_cf',
        'probabilitas_nb',
        'gejala_dipilih',
        'user_id'
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
