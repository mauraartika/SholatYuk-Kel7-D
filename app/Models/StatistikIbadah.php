<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StatistikIbadah extends Model
{
    protected $table = 'statistik_ibadah';

    protected $fillable = [
        'user_id',
        'periode',
        'tanggal_mulai',
        'total_sholat_wajib',
        'total_sholat_sunnah',
        'persentase_tepat_waktu',
        'streak_terpanjang',
        'point',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_mulai' => 'date',
            'total_sholat_wajib' => 'integer',
            'total_sholat_sunnah' => 'integer',
            'persentase_tepat_waktu' => 'decimal:2',
            'streak_terpanjang' => 'integer',
            'point' => 'integer',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
