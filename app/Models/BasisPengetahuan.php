<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BasisPengetahuan extends Model
{
    use HasFactory;

    // Tentukan nama tabel asli di database
    protected $table = 'basis_pengetahuans';

    protected $fillable = [
        'penyakit_id',
        'gejala_id',
        'mb',
        'md',
        'cf_pakar'
    ];

    public function penyakit()
    {
        return $this->belongsTo(Penyakit::class);
    }

    public function gejala()
    {
        return $this->belongsTo(Gejala::class);
    }
}