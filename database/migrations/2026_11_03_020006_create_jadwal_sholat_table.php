<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jadwal_sholat', function (Blueprint $table) {
            $table->id();

            $table->decimal('latitude', 10, 7);
            $table->decimal('longitude', 10, 7);

            $table->string('lokasi')->nullable();

            $table->date('tanggal');

            $table->string('nama_sholat');

            $table->time('waktu_mulai');

            $table->time('waktu_selesai')->nullable();

            $table->timestamps();

            $table->unique([
                'latitude',
                'longitude',
                'tanggal',
                'nama_sholat'
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jadwal_sholat');
    }
};
