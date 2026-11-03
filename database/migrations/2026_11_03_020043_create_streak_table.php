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
        Schema::create('streak', function (Blueprint $table) {
            $table->id();
            $table->enum('tipe', ['pribadi', 'bersama']);
            $table->integer('jumlah_hari')->default(0);
            $table->date('tanggal_mulai')->nullable();
            $table->date('tgl_terakhir_aktif')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('streak');
    }
};
