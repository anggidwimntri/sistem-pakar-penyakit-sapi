<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('riwayat_konsultasis', function (Blueprint $table) {
        $table->id();
        $table->string('nama_peternak');          // Sesuai form konsultasi di Bab 3[cite: 1]
        $table->string('alamat');
        $table->string('penyakit_terdeteksi');
        $table->float('persentase_cf');           // Hasil Certainty Factor[cite: 1]
        $table->float('probabilitas_nb');         // Hasil Naïve Bayes[cite: 1]
        $table->json('gejala_dipilih');           // Menyimpan ID gejala yang dicentang
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_konsultasis');
    }
};
