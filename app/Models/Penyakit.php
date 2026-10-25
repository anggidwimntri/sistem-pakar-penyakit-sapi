<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penyakit extends Model
{
    use HasFactory;
    protected $fillable = [
        'kode_penyakit',
        'nama_penyakit',
        'deskripsi',
        'solusi'
    ];


    // Relasi Many-to-Many ke Gejala
    public function gejalas()
    {
        return $this->belongsToMany(Gejala::class, 'basis_pengetahuans', 'penyakit_id', 'gejala_id');
        // Sesuaikan nama tabel pivot ('basis_pengetahuans') dengan database Anda
    }

    public function artikel()
    {
        return $this->hasOne(Artikel::class, 'penyakit_id');
    }


    // Relasi ke tabel Pengetahuan (untuk ambil daftar gejala)
    public function pengetahuans()
    {
        return $this->hasMany(BasisPengetahuan::class, 'penyakit_id');
    }


}
