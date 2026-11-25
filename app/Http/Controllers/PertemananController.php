<?php

namespace App\Http\Controllers;

use App\Models\Pertemanan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PertemananController extends Controller
{
    /**
     * Menampilkan daftar teman dan permintaan pertemanan.
     */
    public function index()
    {
        $userId = Auth::id();

        $jumlahPesanBelumDibaca = $this->getUnreadSocialMessageCounts($userId);

        // Daftar pertemanan yang sudah diterima
        $teman = Pertemanan::with(['pengguna1', 'pengguna2'])
            ->where('status', 'diterima')
            ->where(function ($query) use ($userId) {
                $query->where('pengguna1_id', $userId)
                    ->orWhere('pengguna2_id', $userId);
            })
            ->get();

        // Permintaan masuk dari pengguna lain
        $permintaanMasuk = Pertemanan::with('pengirim')
            ->where('status', 'pending')
            ->where(function ($query) use ($userId) {
                $query->where('pengguna1_id', $userId)
                    ->orWhere('pengguna2_id', $userId);
            })
            ->where('pengirim_id', '!=', $userId)
            ->get();

        // Permintaan yang dikirim oleh pengguna login
        $permintaanKeluar = Pertemanan::with(['pengguna1', 'pengguna2'])
            ->where('status', 'pending')
            ->where('pengirim_id', $userId)
            ->get();

        return view('teman.index', compact(
            'teman',
            'permintaanMasuk',
            'permintaanKeluar',
            'jumlahPesanBelumDibaca'
        ));
    }

    /**
     * Mencari pengguna dengan gender yang sama.
     */
    public function search(Request $request)
    {
        $request->validate([
            'q' => ['required', 'string', 'min:2', 'max:100'],
        ]);

        $user = Auth::user();
        $keyword = trim($request->q);

        $jumlahPesanBelumDibaca = $this->getUnreadSocialMessageCounts(
            (int) $user->id
        );

        // Cari pengguna dengan gender sama dan bukan akun sendiri
        $hasilPencarian = User::where('id', '!=', $user->id)
            ->where('gender', $user->gender)
            ->whereRaw('LOWER(name) LIKE ?', [
                '%' . strtolower($keyword) . '%'
            ])
            ->whereDoesntHave('pertemananSebagaiPengguna1', function ($query) use ($user) {
                $query->where('pengguna2_id', $user->id);
            })
            ->whereDoesntHave('pertemananSebagaiPengguna2', function ($query) use ($user) {
                $query->where('pengguna1_id', $user->id);
            })
            ->get();

        return view('teman.index', [
            'teman' => Pertemanan::with(['pengguna1', 'pengguna2'])
                ->where('status', 'diterima')
                ->where(function ($query) use ($user) {
                    $query->where('pengguna1_id', $user->id)
                        ->orWhere('pengguna2_id', $user->id);
                })->get(),

            'permintaanMasuk' => Pertemanan::with('pengirim')
                ->where('status', 'pending')
                ->where(function ($query) use ($user) {
                    $query->where('pengguna1_id', $user->id)
                        ->orWhere('pengguna2_id', $user->id);
                })
                ->where('pengirim_id', '!=', $user->id)
                ->get(),

            'permintaanKeluar' => Pertemanan::with(['pengguna1', 'pengguna2'])
                ->where('status', 'pending')
                ->where('pengirim_id', $user->id)
                ->get(),

            'hasilPencarian' => $hasilPencarian,
            'keyword' => $keyword,

            'jumlahPesanBelumDibaca' => $jumlahPesanBelumDibaca,
        ]);
    }

    /**
     * Mengirim permintaan pertemanan.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => ['required', 'integer', 'exists:users,id'],
        ]);

        $pengirim = Auth::user();
        $penerima = User::findOrFail($request->user_id);

        // Tidak boleh menambahkan diri sendiri
        if ($pengirim->id === $penerima->id) {
            return back()->with('error', 'Tidak dapat menambahkan akun sendiri.');
        }

        // Pertemanan hanya untuk pengguna dengan gender sama
        if ($pengirim->gender !== $penerima->gender) {
            return back()->with('error', 'Permintaan hanya dapat dikirim kepada pengguna dengan gender yang sama.');
        }

        // Urutkan ID agar sesuai constraint database
        $pengguna1Id = min($pengirim->id, $penerima->id);
        $pengguna2Id = max($pengirim->id, $penerima->id);

        // Cegah permintaan atau pertemanan ganda
        $sudahAda = Pertemanan::where('pengguna1_id', $pengguna1Id)
            ->where('pengguna2_id', $pengguna2Id)
            ->exists();

        if ($sudahAda) {
            return back()->with('error', 'Permintaan pertemanan sudah pernah dibuat.');
        }

        Pertemanan::create([
            'pengguna1_id' => $pengguna1Id,
            'pengguna2_id' => $pengguna2Id,
            'pengirim_id' => $pengirim->id,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Permintaan pertemanan berhasil dikirim.');
    }

    /**
     * Menerima permintaan pertemanan.
     */
    public function accept($id)
    {
        $userId = Auth::id();
        $jumlahPesanBelumDibaca = $this->getUnreadSocialMessageCounts($userId);

        $permintaan = Pertemanan::where('id', $id)
            ->where('status', 'pending')
            ->where(function ($query) use ($userId) {
                $query->where('pengguna1_id', $userId)
                    ->orWhere('pengguna2_id', $userId);
            })
            ->where('pengirim_id', '!=', $userId)
            ->firstOrFail();

        DB::transaction(function () use ($permintaan) {
            $permintaan->update([
                'status' => 'diterima',
                'tanggal_pertemanan' => now()->toDateString(),
            ]);
        });

        return back()->with('success', 'Permintaan pertemanan berhasil diterima.');
    }

    /**
     * Menolak permintaan pertemanan.
     */
    public function reject($id)
    {
        $userId = Auth::id();

        $permintaan = Pertemanan::where('id', $id)
            ->where('status', 'pending')
            ->where(function ($query) use ($userId) {
                $query->where('pengguna1_id', $userId)
                    ->orWhere('pengguna2_id', $userId);
            })
            ->where('pengirim_id', '!=', $userId)
            ->firstOrFail();

        // Tidak ada status ditolak di enum database.
        // Karena itu, permintaan pending dihapus.
        $permintaan->delete();

        return back()->with('success', 'Permintaan pertemanan ditolak.');
    }

    /**
     * Menghitung pesan pengingat sosial yang belum dibaca
     * berdasarkan masing-masing pengirim.
     */
    private function getUnreadSocialMessageCounts(int $userId)
    {
        return DB::table('notifikasi')
            ->select('pengirim_id', DB::raw('COUNT(*) as total'))
            ->where('penerima_id', $userId)
            ->where('jenis', 'sosial')
            ->whereNotNull('streak_id')
            ->where('status_baca', false)
            ->groupBy('pengirim_id')
            ->pluck('total', 'pengirim_id');
    }
}
