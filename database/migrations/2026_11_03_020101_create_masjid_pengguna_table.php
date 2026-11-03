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
        Schema::create('masjid_pengguna', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('masjid_id')->constrained('masjid')->cascadeOnDelete();
            $table->boolean('dikunjungi')->default(false);
            $table->boolean('favorit')->default(false);
            $table->primary(['user_id', 'masjid_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('masjid_pengguna');
    }
};
