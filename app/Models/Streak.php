<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Streak extends Model
{
    protected $table = 'streak';

    protected $fillable = [
        'tipe',
        'jumlah_hari',
        'tanggal_mulai',
        'tgl_terakhir_aktif',
    ];

    protected function casts(): array
    {
        return [
            'jumlah_hari' => 'integer',
            'tanggal_mulai' => 'date',
            'tgl_terakhir_aktif' => 'date',
        ];
    }

    public function anggota(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'streak_anggota',
            'streak_id',
            'user_id'
        );
    }

    public function notifikasi(): HasMany
    {
        return $this->hasMany(Notifikasi::class, 'streak_id');
    }
}
