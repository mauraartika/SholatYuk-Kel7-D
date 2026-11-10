<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pertemanan', function (Blueprint $table) {
            $table->foreignId('pengirim_id')
                ->after('pengguna2_id')
                ->constrained('users')
                ->cascadeOnDelete();
        });

        DB::statement("
            ALTER TABLE pertemanan
            ADD CONSTRAINT pertemanan_pengguna_berbeda
            CHECK (pengguna1_id < pengguna2_id)
        ");

        DB::statement("
            ALTER TABLE pertemanan
            ADD CONSTRAINT pertemanan_pengirim_valid
            CHECK (
                pengirim_id = pengguna1_id
                OR pengirim_id = pengguna2_id
            )
        ");
    }

    public function down(): void
    {
        DB::statement("
            ALTER TABLE pertemanan
            DROP CONSTRAINT IF EXISTS pertemanan_pengirim_valid
        ");

        DB::statement("
            ALTER TABLE pertemanan
            DROP CONSTRAINT IF EXISTS pertemanan_pengguna_berbeda
        ");

        Schema::table('pertemanan', function (Blueprint $table) {
            $table->dropForeign(['pengirim_id']);
            $table->dropColumn('pengirim_id');
        });
    }
};
