<?php

namespace App\Http\Controllers;

use App\Models\JenisIbadah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class JenisIbadahController extends Controller
{
    // Menampilkan jenis sholat sunnah global dan milik pengguna
    public function index()
    {
        $user = Auth::user();

        $jenisIbadah = JenisIbadah::where('kategori', 'sunnah')
            ->where(function ($query) use ($user) {
                $query->whereNull('user_id')
                    ->orWhere('user_id', $user->id);
            })
            ->orderBy('id')
            ->get();

        return response()->json([
            'message' => 'Daftar sholat sunnah berhasil diambil.',
            'data' => $jenisIbadah,
        ]);
    }

    // Menambahkan jenis sholat sunnah khusus
    public function store(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'nama_ibadah' => [
                'required',
                'string',
                'max:255',
            ],
            'keterangan' => [
                'nullable',
                'string',
            ],
        ]);

        $namaSudahAda = JenisIbadah::where('nama_ibadah', $validated['nama_ibadah'])
            ->where(function ($query) use ($user) {
                $query->whereNull('user_id')
                    ->orWhere('user_id', $user->id);
            })
            ->exists();

        if ($namaSudahAda) {
            return response()->json([
                'message' => 'Nama sholat tersebut sudah tersedia.',
            ], 422);
        }

        $jenisIbadah = JenisIbadah::create([
            'user_id' => $user->id,
            'nama_ibadah' => $validated['nama_ibadah'],
            'kategori' => 'sunnah',
            'keterangan' => $validated['keterangan'] ?? null,
        ]);

        return response()->json([
            'message' => 'Sholat sunnah berhasil ditambahkan.',
            'data' => $jenisIbadah,
        ], 201);
    }

    // Mengubah jenis sholat sunnah milik pengguna
    public function update(Request $request, $id)
    {
        $user = Auth::user();

        $jenisIbadah = JenisIbadah::where('id', $id)
            ->where('user_id', $user->id)
            ->where('kategori', 'sunnah')
            ->firstOrFail();

        $validated = $request->validate([
            'nama_ibadah' => [
                'required',
                'string',
                'max:255',
                Rule::unique('jenis_ibadah', 'nama_ibadah')
                    ->where('user_id', $user->id)
                    ->ignore($jenisIbadah->id),
            ],
            'keterangan' => [
                'nullable',
                'string',
            ],
        ]);

        $namaGlobalSudahAda = JenisIbadah::whereNull('user_id')
            ->where('nama_ibadah', $validated['nama_ibadah'])
            ->exists();

        if ($namaGlobalSudahAda) {
            return response()->json([
                'message' => 'Nama sholat tersebut sudah tersedia.',
            ], 422);
        }

        $jenisIbadah->update($validated);

        return response()->json([
            'message' => 'Sholat sunnah berhasil diperbarui.',
            'data' => $jenisIbadah,
        ]);
    }

    // Menghapus jenis sholat sunnah milik pengguna
    public function destroy($id)
    {
        $user = Auth::user();

        $jenisIbadah = JenisIbadah::where('id', $id)
            ->where('user_id', $user->id)
            ->where('kategori', 'sunnah')
            ->firstOrFail();

        if ($jenisIbadah->ibadahSholat()->exists()) {
            return response()->json([
                'message' => 'Sholat ini sudah memiliki riwayat ibadah dan tidak dapat dihapus.',
            ], 409);
        }

        $jenisIbadah->delete();

        return response()->json([
            'message' => 'Sholat sunnah berhasil dihapus.',
        ]);
    }
}
