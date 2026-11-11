<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JenisIbadah extends Model
{
    protected $table = 'jenis_ibadah';

    protected $fillable = [
        'user_id',
        'nama_ibadah',
        'kategori',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function ibadahSholat(): HasMany
    {
        return $this->hasMany(IbadahSholat::class);
    }
}
