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
        Schema::create('jadwal_sholat', function (Blueprint $table) {
            $table->id();
            $table->string('nama_sholat');
            $table->enum('kategori', ['wajib', 'sunnah']);
            $table->date('tanggal');
            $table->string('lokasi')->nullable();
            $table->time('waktu_mulai');
            $table->time('waktu_selesai');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_sholat');
    }
};
