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
        Schema::create('ibadah_sholat', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('jadwal_id')->nullable()->constrained('jadwal_sholat');
            $table->string('jenis_sholat');
            $table->enum('kategori', ['wajib', 'sunnah']);
            $table->date('tanggal');
            $table->time('waktu_pelaksanaan')->nullable();
            $table->enum('status', ['selesai', 'belum', 'libur'])->default('belum');
            $table->string('keterangan')->nullable();
            $table->timestamps();
            $table->unique(['user_id', 'jenis_sholat', 'tanggal']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ibadah_sholat');
    }
};
