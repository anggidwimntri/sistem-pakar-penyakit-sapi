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
    Schema::create('basis_pengetahuans', function (Blueprint $table) {
        $table->id();
        $table->foreignId('penyakit_id')->constrained('penyakits')->onDelete('cascade');
        $table->foreignId('gejala_id')->constrained('gejalas')->onDelete('cascade');
        
        // Untuk Perhitungan Certainty Factor (CF)[cite: 1]
        $table->float('mb')->default(0);           // Measure of Belief[cite: 1]
        $table->float('md')->default(0);           // Measure of Disbelief[cite: 1]
        $table->float('cf_pakar')->default(0);     // Nilai CF Pakar (MB - MD)[cite: 1]
        
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('basis_pengetahuans');
    }
};
