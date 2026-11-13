<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SuaraAdzan extends Model
{
    protected $table = 'suara_adzan';

    protected $fillable = [
        'user_id',
        'nama_suara',
        'file_audio',
        'status',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
