<?php

namespace App\Http\Controllers;

use App\Models\IbadahSholat;
use App\Models\JenisIbadah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class IbadahController extends Controller
{
    // Menampilkan riwayat ibadah pengguna
    public function index(Request $request)
    {
        $user = Auth::user();

        $riwayat = $user->ibadahSholat()
            ->with('jenisIbadah')
            ->orderByDesc('tanggal')
            ->get();

        return response()->json([
            'message' => 'Riwayat ibadah berhasil diambil.',
            'data' => $riwayat,
        ]);
    }

    // Menyimpan atau memperbarui catatan ibadah
    public function store(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'jenis_ibadah_id' => [
                'required',
                'integer',
                Rule::exists('jenis_ibadah', 'id')
                    ->where(function ($query) use ($user) {
                        $query->whereNull('user_id')
                            ->orWhere('user_id', $user->id);
                    }),
            ],
            'tanggal' => ['required', 'date'],
            'waktu_pelaksanaan' => ['nullable', 'date_format:H:i'],
            'tepat_waktu' => ['nullable', 'boolean'],
            'status' => ['required', Rule::in(['selesai', 'belum', 'libur'])],
            'keterangan' => ['nullable', 'string', 'max:255'],
        ]);

        // Periksa kategori ibadah
        $jenisIbadah = JenisIbadah::findOrFail(
            $validated['jenis_ibadah_id']
        );

        // Mode Libur hanya membatasi pencatatan sholat wajib
        if (
            $user->mode_libur &&
            $jenisIbadah->kategori === 'wajib'
        ) {
            return response()->json([
                'message' => 'Pencatatan sholat wajib dijeda selama Mode Libur aktif.',
            ], 403);
        }

        $ibadah = IbadahSholat::updateOrCreate(
            [
                'user_id' => $user->id,
                'jenis_ibadah_id' => $validated['jenis_ibadah_id'],
                'tanggal' => $validated['tanggal'],
            ],
            $validated
        );

        return response()->json([
            'message' => 'Catatan ibadah berhasil disimpan.',
            'data' => $ibadah->load('jenisIbadah'),
        ], 201);
    }
}
