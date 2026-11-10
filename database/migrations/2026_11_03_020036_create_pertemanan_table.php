<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pertemanan', function (Blueprint $table) {
            $table->id();

            $table->foreignId('pengguna1_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('pengguna2_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->enum('status', ['pending', 'diterima'])
                ->default('pending');

            $table->date('tanggal_pertemanan')->nullable();

            $table->timestamps();

            $table->unique(['pengguna1_id', 'pengguna2_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pertemanan');
    }
};
