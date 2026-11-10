<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jenis_ibadah', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->cascadeOnDelete();

            $table->string('nama_ibadah');

            $table->enum('kategori', ['wajib', 'sunnah']);

            $table->timestamps();

            $table->unique(['user_id', 'nama_ibadah']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jenis_ibadah');
    }
};
