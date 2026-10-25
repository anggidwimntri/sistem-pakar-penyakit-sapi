<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    use HasFactory;

    // Tentukan kolom yang boleh diisi (mass assignable)
    protected $fillable = [
        'penyakit_id',
        'konten_lengkap',
        'penanganan',
        'gambar',
    ];

    /**
     * Relasi ke tabel Penyakit
     * Satu artikel/informasi dimiliki oleh satu penyakit
     */
    public function penyakit()
    {
        return $this->belongsTo(Penyakit::class, 'penyakit_id');
    }
}