<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gejala extends Model
{
    use HasFactory;

    // Tambahkan baris ini agar model mengizinkan kolom-kolom ini diisi
    protected $fillable = [
        'kode_gejala',
        'nama_gejala',
    ];
}