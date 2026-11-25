<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('notifikasi', function (Blueprint $table) {
            $table->foreignId('streak_id')
                ->nullable()
                ->constrained('streak')
                ->nullOnDelete();

            $table->index('streak_id');
        });
    }

    public function down(): void
    {
        Schema::table('notifikasi', function (Blueprint $table) {
            $table->dropForeign(['streak_id']);
            $table->dropIndex(['streak_id']);
            $table->dropColumn('streak_id');
        });
    }
};
