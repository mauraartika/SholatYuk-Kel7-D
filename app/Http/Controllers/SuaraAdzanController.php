<?php

namespace App\Http\Controllers;

use App\Models\SuaraAdzan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SuaraAdzanController extends Controller
{
    /**
     * Menampilkan audio bawaan dan audio milik pengguna.
     */
    public function index()
    {
        $user = auth()->user();

        $suaraAdzan = SuaraAdzan::query()
            ->whereNull('user_id')
            ->orWhere('user_id', $user->id)
            ->orderBy('nama_suara')
            ->get();

        return response()->json(
            $suaraAdzan->map(function ($suara) use ($user) {
                return [
                    'id' => $suara->id,
                    'nama_suara' => $suara->nama_suara,
                    'file_audio' => Storage::disk('public')
                        ->url($suara->file_audio),
                    'status' => $suara->status,
                    'is_custom' => $suara->user_id !== null,
                    'is_selected' => $user->suara_adzan_id !== null
                        && (int) $user->suara_adzan_id === (int) $suara->id,
                ];
            })
        );
    }

    /**
     * Mengunggah suara adzan custom.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_suara' => ['required', 'string', 'max:255'],
            'file_audio' => [
                'required',
                'file',
                'mimes:mp3',
                'max:5120',
            ],
        ]);

        $path = $request->file('file_audio')
            ->store('suara-adzan', 'public');

        $suara = SuaraAdzan::create([
            'user_id' => auth()->id(),
            'nama_suara' => $validated['nama_suara'],
            'file_audio' => $path,
            'status' => 'aktif',
        ]);

        return response()->json([
            'message' => 'Suara adzan berhasil diunggah.',
            'data' => [
                'id' => $suara->id,
                'nama_suara' => $suara->nama_suara,
                'file_audio' => Storage::disk('public')->url($path),
                'status' => $suara->status,
                'is_custom' => true,
            ],
        ], 201);
    }

    /**
     * Menghapus audio custom milik pengguna.
     */
    public function destroy(string $id)
    {
        $suara = SuaraAdzan::query()
            ->where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        Storage::disk('public')->delete($suara->file_audio);

        $suara->delete();

        return response()->json([
            'message' => 'Suara adzan berhasil dihapus.',
        ]);
    }

    public function select(Request $request)
    {
        $validated = $request->validate([
            'suara_adzan_id' => ['required', 'integer', 'exists:suara_adzan,id'],
        ]);

        $user = auth()->user();

        $suara = SuaraAdzan::query()
            ->where('id', $validated['suara_adzan_id'])
            ->where(function ($query) use ($user) {
                $query->whereNull('user_id')
                    ->orWhere('user_id', $user->id);
            })
            ->firstOrFail();

        $user->suara_adzan_id = $suara->id;
        $user->save();

        return response()->json([
            'message' => 'Pilihan suara adzan berhasil disimpan.',
            'suara_adzan_id' => $suara->id,
        ]);
    }
}
