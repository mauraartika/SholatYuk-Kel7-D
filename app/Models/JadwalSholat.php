<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JadwalSholat extends Model
{
    protected $table = 'jadwal_sholat';

    protected $fillable = [
        'latitude',
        'longitude',
        'lokasi',
        'tanggal',
        'nama_sholat',
        'waktu_mulai',
        'waktu_selesai',
    ];

    protected function casts(): array
    {
        return [
            'latitude' => 'decimal:7',
            'longitude' => 'decimal:7',
            'tanggal' => 'date',
        ];
    }

    public function ibadahSholat(): HasMany
    {
        return $this->hasMany(IbadahSholat::class, 'jadwal_id');
    }
}
