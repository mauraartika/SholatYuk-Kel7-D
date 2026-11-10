<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('statistik_ibadah', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->enum('periode', ['harian', 'mingguan', 'bulanan']);

            $table->date('tanggal_mulai');

            $table->integer('total_sholat_wajib')->default(0);

            $table->integer('total_sholat_sunnah')->default(0);

            $table->decimal('persentase_tepat_waktu', 5, 2)->default(0);

            $table->integer('streak_terpanjang')->default(0);

            $table->integer('point')->default(0);

            $table->timestamps();

            $table->unique(['user_id', 'periode', 'tanggal_mulai']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('statistik_ibadah');
    }
};
