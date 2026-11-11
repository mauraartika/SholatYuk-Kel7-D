<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pertemanan extends Model
{
    protected $table = 'pertemanan';

    protected $fillable = [
        'pengguna1_id',
        'pengguna2_id',
        'pengirim_id',
        'status',
        'tanggal_pertemanan',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_pertemanan' => 'date',
        ];
    }

    public function pengguna1(): BelongsTo
    {
        return $this->belongsTo(User::class, 'pengguna1_id');
    }

    public function pengguna2(): BelongsTo
    {
        return $this->belongsTo(User::class, 'pengguna2_id');
    }

    public function pengirim(): BelongsTo
    {
        return $this->belongsTo(User::class, 'pengirim_id');
    }
}
