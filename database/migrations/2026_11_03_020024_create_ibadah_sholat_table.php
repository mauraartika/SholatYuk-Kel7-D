<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ibadah_sholat', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('jenis_ibadah_id')
                ->constrained('jenis_ibadah')
                ->restrictOnDelete();

            $table->foreignId('jadwal_id')
                ->nullable()
                ->constrained('jadwal_sholat')
                ->nullOnDelete();

            $table->date('tanggal');

            $table->time('waktu_pelaksanaan')->nullable();

            $table->boolean('tepat_waktu')->nullable();

            $table->enum('status', ['selesai', 'belum', 'libur'])
                ->default('belum');

            $table->string('keterangan')->nullable();

            $table->timestamps();

            $table->unique(['user_id', 'jenis_ibadah_id', 'tanggal']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ibadah_sholat');
    }
};
