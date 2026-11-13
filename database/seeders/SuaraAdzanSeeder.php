<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SuaraAdzanSeeder extends Seeder
{
    public function run(): void
    {
        $suaraAdzan = [
            [
                'nama_suara' => 'Adzan Al-Aqsa',
                'file_audio' => 'suara-adzan/adzanalaqsa.mp3',
            ],
            [
                'nama_suara' => 'Adzan Default',
                'file_audio' => 'suara-adzan/adzanaplikasi.mp3',
            ],
            [
                'nama_suara' => 'Adzan Madinah',
                'file_audio' => 'suara-adzan/adzanmadinah.mp3',
            ],
            [
                'nama_suara' => 'Adzan Makkah',
                'file_audio' => 'suara-adzan/adzanmekkah.mp3',
            ],
            [
                'nama_suara' => 'Adzan Subuh',
                'file_audio' => 'suara-adzan/adzansubuh.mp3',
            ],
        ];

        foreach ($suaraAdzan as $suara) {
            DB::table('suara_adzan')->updateOrInsert(
                [
                    'nama_suara' => $suara['nama_suara'],
                    'user_id' => null,
                ],
                [
                    'file_audio' => $suara['file_audio'],
                    'status' => 'aktif',
                    'updated_at' => now(),
                    'created_at' => now(),
                ]
            );
        }
    }
}
