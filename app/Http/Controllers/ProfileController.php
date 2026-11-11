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

    // Cek apakah DnD aktif
    $isDndActive = $request->has('dnd');

    $user->dnd = $isDndActive ? 1 : 0;
    $user->mode_libur = $request->has('mode_libur') ? 1 : 0;

    // Logika Pemaksaan Backend:
    // Jika DnD aktif, paksa notif lain menjadi 0.
    // Jika tidak, gunakan nilai dari checkbox yang dikirimkan.
    if ($isDndActive) {
        $user->notif_adzan_aktif = 0;
        $user->notif_dalil_aktif = 0;
    } else {
        $user->notif_adzan_aktif = $request->has('notif_adzan_aktif') ? 1 : 0;
        $user->notif_dalil_aktif = $request->has('notif_dalil_aktif') ? 1 : 0;
    }

    $user->save();

    return back()->with('success', 'Preferensi berhasil diperbarui!');
}
}
