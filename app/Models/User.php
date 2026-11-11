<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'gender',
        'tanggal_lahir',
        'lokasi',
        'latitude',
        'longitude',
        'mode_libur',
        'notif_adzan_aktif',
        'notif_dalil_aktif',
        'dnd',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relasi pertemanan sebagai pengguna pertama
    public function pertemananSebagaiPengguna1(): HasMany
    {
        return $this->hasMany(Pertemanan::class, 'pengguna1_id');
    }

    // Relasi pertemanan sebagai pengguna kedua
    public function pertemananSebagaiPengguna2(): HasMany
    {
        return $this->hasMany(Pertemanan::class, 'pengguna2_id');
    }

    // Relasi pertemanan yang dikirim oleh pengguna
    public function permintaanPertemananDikirim(): HasMany
    {
        return $this->hasMany(Pertemanan::class, 'pengirim_id');
    }
}
