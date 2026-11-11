<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Dalil extends Model
{
    protected $table = 'dalil';

    protected $fillable = [
        'isi_dalil',
        'terjemahan',
        'sumber',
        'kategori',
    ];

    public function notifikasi(): HasMany
    {
        return $this->hasMany(Notifikasi::class, 'dalil_id');
    }
}
