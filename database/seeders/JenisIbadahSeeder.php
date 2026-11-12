<?php

namespace Database\Seeders;

use App\Models\JenisIbadah;
use Illuminate\Database\Seeder;

class JenisIbadahSeeder extends Seeder
{
    public function run(): void
    {
        $jenisIbadah = [
            ['nama_ibadah' => 'Subuh', 'kategori' => 'wajib'],
            ['nama_ibadah' => 'Dzuhur', 'kategori' => 'wajib'],
            ['nama_ibadah' => 'Ashar', 'kategori' => 'wajib'],
            ['nama_ibadah' => 'Maghrib', 'kategori' => 'wajib'],
            ['nama_ibadah' => 'Isya', 'kategori' => 'wajib'],

            ['nama_ibadah' => 'Rawatib', 'kategori' => 'sunnah'],
            ['nama_ibadah' => 'Dhuha', 'kategori' => 'sunnah'],
            ['nama_ibadah' => 'Tahajud', 'kategori' => 'sunnah'],
            ['nama_ibadah' => 'Witir', 'kategori' => 'sunnah'],
        ];

        foreach ($jenisIbadah as $item) {
            JenisIbadah::updateOrCreate(
                [
                    'user_id' => null,
                    'nama_ibadah' => $item['nama_ibadah'],
                ],
                [
                    'kategori' => $item['kategori'],
                ]
            );
        }
    }
}
