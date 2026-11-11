<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class IbadahSholat extends Model
{
    protected $table = 'ibadah_sholat';

    protected $fillable = [
        'user_id',
        'jenis_ibadah_id',
        'jadwal_id',
        'tanggal',
        'waktu_pelaksanaan',
        'tepat_waktu',
        'status',
        'keterangan',
    ];

    protected function casts(): array
    {
        return [
            'tanggal' => 'date',
            'tepat_waktu' => 'boolean',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function jenisIbadah(): BelongsTo
    {
        return $this->belongsTo(JenisIbadah::class);
    }

    public function jadwal(): BelongsTo
    {
        return $this->belongsTo(JadwalSholat::class, 'jadwal_id');
    }
}
