<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Notifikasi extends Model
{
    protected $table = 'notifikasi';

    protected $fillable = [
        'pengirim_id',
        'penerima_id',
        'dalil_id',
        'streak_id',
        'jenis',
        'isi_pesan',
        'waktu_kirim',
        'status_baca',
    ];

    protected function casts(): array
    {
        return [
            'waktu_kirim' => 'datetime',
            'status_baca' => 'boolean',
        ];
    }

    public function pengirim(): BelongsTo
    {
        return $this->belongsTo(User::class, 'pengirim_id');
    }

    public function penerima(): BelongsTo
    {
        return $this->belongsTo(User::class, 'penerima_id');
    }

    public function dalil(): BelongsTo
    {
        return $this->belongsTo(Dalil::class, 'dalil_id');
    }

    public function streak(): BelongsTo
    {
        return $this->belongsTo(Streak::class, 'streak_id');
    }
}
