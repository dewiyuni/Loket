<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('antrean', function (Blueprint $table) {
            $table->id();
            $table->string('kode_booking')->unique();
            $table->foreignId('pasien_id')->constrained('pasien')->onDelete('cascade');
            $table->string('poli_tujuan');
            $table->string('nomor_antrean');
            $table->string('metode_pembayaran')->default('Umum/Mandiri');
            $table->enum('status', ['booking', 'menunggu', 'dipanggil', 'selesai', 'dilewati'])->default('menunggu');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('antrean');
    }
};
