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
    Schema::create('gejalas', function (Blueprint $table) {
        $table->id();
        $table->string('kode_gejala')->unique();   // KG001, KG002, dst[cite: 1]
        $table->string('nama_gejala');             // Tubuh sapi kurus, dst[cite: 1]
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gejalas');
    }
};
