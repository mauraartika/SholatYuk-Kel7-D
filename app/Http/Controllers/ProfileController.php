<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile');
    }

    public function updatePreferences(Request $request)
    {
        $user = Auth::user();

        DB::transaction(function () use ($request, $user) {
            $modeLiburSebelumnya = (bool) $user->mode_libur;
            $modeLiburSekarang = $request->boolean('mode_libur');

            // Aktivasi Mode Libur
            if (!$modeLiburSebelumnya && $modeLiburSekarang) {
                $user->tgl_mulai_libur = now()->toDateString();
            }

            // Deaktivasi Mode Libur
            if ($modeLiburSebelumnya && !$modeLiburSekarang) {
                if ($user->tgl_mulai_libur) {
                    $tanggalMulai = Carbon::parse($user->tgl_mulai_libur);
                    $tanggalSekarang = now()->startOfDay();

                    $durasiLibur = max(
                        0,
                        (int) $tanggalMulai->startOfDay()
                            ->diffInDays($tanggalSekarang)
                    );

                    // Sesuaikan tanggal aktivitas streak pribadi
                    if ($durasiLibur > 0) {
                        $streakPribadi = $user->streaks()
                            ->where('streak.tipe', 'pribadi')
                            ->whereNotNull('streak.tgl_terakhir_aktif')
                            ->get();

                        foreach ($streakPribadi as $streak) {
                            $streak->tgl_terakhir_aktif =
                                Carbon::parse($streak->tgl_terakhir_aktif)
                                    ->addDays($durasiLibur);

                            $streak->save();
                        }
                    }
                }

                $user->tgl_mulai_libur = null;
            }

            $user->mode_libur = $modeLiburSekarang;

            // Pengaturan DND
            $user->dnd = $request->boolean('dnd');

            // Saat DND aktif, pertahankan preferensi notifikasi sebelumnya.
            // Saat DND nonaktif, pengguna dapat memperbarui preferensinya.
            if (!$user->dnd) {
                $user->notif_adzan_aktif =
                    $request->boolean('notif_adzan_aktif');

                $user->notif_dalil_aktif =
                    $request->boolean('notif_dalil_aktif');
            }

            $user->save();
        });

        return back()->with(
            'success',
            'Preferensi berhasil diperbarui!'
        );
    }
}
