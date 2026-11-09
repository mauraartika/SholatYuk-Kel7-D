<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    // Method untuk menampilkan halaman profil (opsional jika belum ada)
    public function index()
    {
        return view('profile');
    }

    // Method untuk mengupdate toggle preferensi
    public function updatePreferences(Request $request)
    {
        $user = Auth::user();

        // Konversi nilai checkbox menjadi 1 (aktif) atau 0 (nonaktif)
        $user->mode_libur = $request->has('mode_libur') ? 1 : 0;
        $user->notif_adzan_aktif = $request->has('notif_adzan_aktif') ? 1 : 0;
        $user->notif_dalil_aktif = $request->has('notif_dalil_aktif') ? 1 : 0;

        $user->save();

        return back()->with('success', 'Preferensi berhasil diperbarui!');
    }
}
