<?php

namespace App\Services;

use App\Models\Streak;
use App\Models\User;
use App\Models\Pertemanan;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use RuntimeException;

class SharedStreakService
{
    /**
     * Menghitung streak bersama berdasarkan pengingat
     * timbal balik antara dua pengguna.
     *
     * Kedua pengguna wajib saling mengirim minimal satu
     * pengingat setiap hari kalender.
     */
    public function sync(User $user, User $friend): array
    {
        if ($user->id === $friend->id) {
            throw new RuntimeException(
                'Streak bersama tidak dapat dibuat dengan akun sendiri.'
            );
        }

        return DB::transaction(function () use ($user, $friend) {

            $userId = (int) $user->id;
            $friendId = (int) $friend->id;

            // Urutkan ID agar sesuai struktur tabel pertemanan.
            $pengguna1Id = min($userId, $friendId);
            $pengguna2Id = max($userId, $friendId);

            // Pastikan kedua pengguna sudah berteman.
            // Lock baris pertemanan untuk mencegah pembuatan
            // streak ganda secara bersamaan.
            Pertemanan::query()
                ->where('pengguna1_id', $pengguna1Id)
                ->where('pengguna2_id', $pengguna2Id)
                ->where('status', 'diterima')
                ->lockForUpdate()
                ->firstOrFail();

            // Cari streak bersama yang dimiliki kedua pengguna.
            $streaks = Streak::query()
                ->where('tipe', 'bersama')
                ->whereHas('anggota', function ($query) use ($userId) {
                    $query->where('users.id', $userId);
                })
                ->whereHas('anggota', function ($query) use ($friendId) {
                    $query->where('users.id', $friendId);
                })
                ->with('anggota:id')
                ->lockForUpdate()
                ->get();

            // Satu pasangan hanya boleh memiliki satu streak bersama.
            if ($streaks->count() > 1) {
                throw new RuntimeException(
                    'Ditemukan lebih dari satu streak bersama untuk pasangan ini.'
                );
            }

            $streak = $streaks->first();

            if ($streak) {

                // Pastikan anggota streak tepat dua orang.
                $anggotaIds = $streak->anggota
                    ->pluck('id')
                    ->map(fn ($id) => (int) $id)
                    ->sort()
                    ->values()
                    ->all();

                if ($anggotaIds !== [$pengguna1Id, $pengguna2Id]) {
                    throw new RuntimeException(
                        'Anggota streak bersama tidak sesuai dengan pasangan pengguna.'
                    );
                }

            } else {

                // Buat streak bersama jika belum tersedia.
                $streak = Streak::create([
                    'tipe' => 'bersama',
                    'jumlah_hari' => 0,
                    'tanggal_mulai' => null,
                    'tgl_terakhir_aktif' => null,
                ]);

                $streak->anggota()->attach([
                    $pengguna1Id,
                    $pengguna2Id,
                ]);
            }

            // Gunakan zona waktu aplikasi.
            $today = Carbon::today(config('app.timezone'));
            $todayString = $today->toDateString();

            // Ambil aktivitas pengingat yang valid:
            // A mengirim kepada B atau B mengirim kepada A.
            $activities = DB::table('notifikasi')
                ->selectRaw(
                    'DATE(waktu_kirim) AS tanggal, pengirim_id'
                )
                ->where('streak_id', $streak->id)
                ->where('jenis', 'sosial')
                ->whereDate('waktu_kirim', '<=', $todayString)
                ->where(function ($query) use ($userId, $friendId) {

                    $query->where(function ($subQuery) use ($userId, $friendId) {
                        $subQuery
                            ->where('pengirim_id', $userId)
                            ->where('penerima_id', $friendId);
                    })

                    ->orWhere(function ($subQuery) use ($userId, $friendId) {
                        $subQuery
                            ->where('pengirim_id', $friendId)
                            ->where('penerima_id', $userId);
                    });

                })
                ->distinct()
                ->get();

            // Susun aktivitas berdasarkan tanggal dan pengirim.
            // Banyak pengiriman dari satu orang pada hari yang sama
            // tetap dihitung sebagai satu aktivitas.
            $dailyActivity = [];

            foreach ($activities as $activity) {
                $date = Carbon::parse($activity->tanggal)
                    ->toDateString();

                $dailyActivity[$date][(int) $activity->pengirim_id] = true;
            }

            // Periksa apakah kedua pengguna sudah saling mengirim
            // pada tanggal tertentu.
            $isMutualActivity = function (string $date) use (
                $dailyActivity,
                $userId,
                $friendId
            ): bool {

                return isset($dailyActivity[$date][$userId])
                    && isset($dailyActivity[$date][$friendId]);
            };

            $run = 0;
            $runStart = null;
            $lastComplete = null;

            // Jika hari ini belum timbal balik, jangan langsung
            // menganggapnya gagal. Periksa mulai dari kemarin.
            $checkDate = $today->copy();

            if (!$isMutualActivity($todayString)) {
                $checkDate->subDay();
            }

            // Hitung rangkaian hari timbal balik dari tanggal terbaru.
            while (true) {

                $dateString = $checkDate->toDateString();

                if (!$isMutualActivity($dateString)) {
                    break;
                }

                $run++;

                if ($lastComplete === null) {
                    $lastComplete = $dateString;
                }

                $runStart = $dateString;

                $checkDate->subDay();
            }

            // Simpan hasil perhitungan streak bersama.
            $streak->update([
                'jumlah_hari' => $run,
                'tanggal_mulai' => $runStart,
                'tgl_terakhir_aktif' => $lastComplete,
            ]);

            return [
                'aktif' => $run >= 3,
                'jumlah_hari' => $run,
                'progres_aktivasi' => min($run, 3),
                'tanggal_mulai' => $runStart,
                'tgl_terakhir_aktif' => $lastComplete,
                'streak_id' => $streak->id,
                'anggota' => [$pengguna1Id, $pengguna2Id],
            ];
        });
    }
}
