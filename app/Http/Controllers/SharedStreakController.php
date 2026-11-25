<?php

namespace App\Http\Controllers;

use App\Models\Notifikasi;
use App\Models\Pertemanan;
use App\Models\User;
use App\Services\SharedStreakService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SharedStreakController extends Controller
{
    /**
     * Template pengingat yang diperbolehkan.
     * Pengguna hanya mengirimkan kunci template,
     * bukan teks bebas.
     */
    private const REMINDER_TEMPLATES = [
        'subuh' => 'Jangan lupa menunaikan salat Subuh, ya!',
        'dzuhur' => 'Sudah masuk waktu salat Dzuhur. Yuk, tunaikan salat!',
        'ashar' => 'Jangan lupa salat Ashar hari ini, ya!',
        'maghrib' => 'Waktu Maghrib sudah tiba. Yuk, salat!',
        'isya' => 'Jangan lupa menunaikan salat Isya!',
        'semangat' => 'Semangat menjaga ibadah hari ini. Jangan lupa salat!',
    ];

    /**
     * Memastikan pengguna yang dituju adalah teman
     * yang sudah menerima permintaan pertemanan.
     */
    private function getAcceptedFriend(int $friendId): User
    {
        $user = Auth::user();

        abort_if(
            $user->id === $friendId,
            403,
            'Tidak dapat membuka streak bersama dengan akun sendiri.'
        );

        $pengguna1Id = min((int) $user->id, $friendId);
        $pengguna2Id = max((int) $user->id, $friendId);

        $isFriend = Pertemanan::query()
            ->where('pengguna1_id', $pengguna1Id)
            ->where('pengguna2_id', $pengguna2Id)
            ->where('status', 'diterima')
            ->exists();

        abort_unless(
            $isFriend,
            403,
            'Pengguna tersebut belum menjadi teman Anda.'
        );

        return User::findOrFail($friendId);
    }

    /**
     * Membuka ruang streak bersama.
     * Record dibuat ketika ruang pertama kali dibuka.
     */

    public function show(
        int $id,
        SharedStreakService $sharedStreakService
    ) {
        $user = Auth::user();
        $friend = $this->getAcceptedFriend($id);

        $streak = $sharedStreakService->sync(
            $user,
            $friend
        );

        Notifikasi::query()
            ->where('streak_id', $streak['streak_id'])
            ->where('jenis', 'sosial')
            ->where('pengirim_id', $friend->id)
            ->where('penerima_id', $user->id)
            ->where('status_baca', false)
            ->update(['status_baca' => true]);

        // Ambil pesan percakapan untuk streak bersama ini.
        $queryPesan = Notifikasi::query()
            ->where('streak_id', $streak['streak_id'])
            ->where('jenis', 'sosial')
            ->where(function ($query) use ($user, $friend) {
                $query->where(function ($subQuery) use ($user, $friend) {
                    $subQuery->where('pengirim_id', $user->id)
                        ->where('penerima_id', $friend->id);
                })->orWhere(function ($subQuery) use ($user, $friend) {
                    $subQuery->where('pengirim_id', $friend->id)
                        ->where('penerima_id', $user->id);
                });
            });

        // Riwayat pesan ditampilkan dari yang paling lama.
        $pesan = (clone $queryPesan)
            ->with('pengirim:id,name')
            ->orderBy('waktu_kirim')
            ->orderBy('id')
            ->get();

        // Periksa aktivitas kedua anggota pada hari ini.
        $hariIni = now(config('app.timezone'))->toDateString();

        $pengirimHariIni = (clone $queryPesan)
            ->whereDate('waktu_kirim', $hariIni)
            ->distinct()
            ->pluck('pengirim_id')
            ->map(fn($id) => (int) $id);

        return view('teman.streak-bersama', [
            'teman' => $friend,
            'streak' => $streak,
            'templates' => self::REMINDER_TEMPLATES,
            'pesan' => $pesan,
            'kamuSudahMengirim' => $pengirimHariIni->contains((int) $user->id),
            'temanSudahMengirim' => $pengirimHariIni->contains((int) $friend->id),
        ]);
    }


    /**
     * Mengirim pengingat kepada teman.
     */
    public function sendReminder(
        Request $request,
        int $id,
        SharedStreakService $sharedStreakService
    ) {
        $request->validate([
            'template' => [
                'required',
                'string',
                'in:' . implode(',', array_keys(self::REMINDER_TEMPLATES)),
            ],
        ]);

        $user = Auth::user();
        $friend = $this->getAcceptedFriend($id);

        $message = self::REMINDER_TEMPLATES[$request->input('template')];

        $result = DB::transaction(function () use (
            $user,
            $friend,
            $message,
            $sharedStreakService
        ) {
            // Pastikan ruang streak sudah tersedia.
            $streak = $sharedStreakService->sync(
                $user,
                $friend
            );

            // Simpan notifikasi pengingat sosial.
            Notifikasi::create([
                'pengirim_id' => $user->id,
                'penerima_id' => $friend->id,
                'streak_id' => $streak['streak_id'],
                'jenis' => 'sosial',
                'isi_pesan' => $message,
                'waktu_kirim' => now(),
                'status_baca' => false,
            ]);

            // Hitung ulang setelah pengingat tersimpan.
            return $sharedStreakService->sync(
                $user,
                $friend
            );
        });

        return back()->with(
            'success',
            'Pengingat berhasil dikirim.'
        )->with('streak', $result);
    }

    /**
     * Mengambil status streak bersama dalam format JSON.
     */
    public function status(
        int $id,
        SharedStreakService $sharedStreakService
    ) {
        $friend = $this->getAcceptedFriend($id);

        $streak = $sharedStreakService->sync(
            Auth::user(),
            $friend
        );

        return response()->json($streak);
    }
}
