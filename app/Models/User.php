<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

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
        'suara_adzan_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'mode_libur' => 'boolean',
            'dnd' => 'boolean',
            'notif_adzan_aktif' => 'boolean',
            'notif_dalil_aktif' => 'boolean',
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

    // Relasi riwayat ibadah sholat pengguna
    public function ibadahSholat(): HasMany
    {
        return $this->hasMany(IbadahSholat::class);
    }

    // Relasi jenis ibadah yang dibuat pengguna
    public function jenisIbadah(): HasMany
    {
        return $this->hasMany(JenisIbadah::class);
    }

    // Relasi suara adzan milik pengguna
    public function suaraAdzan(): HasMany
    {
        return $this->hasMany(SuaraAdzan::class);
    }

    // Relasi suara adzan yang dipilih pengguna
    public function suaraAdzanTerpilih(): BelongsTo
    {
        return $this->belongsTo(SuaraAdzan::class, 'suara_adzan_id');
    }

    // Relasi seluruh jenis ibadah yang tersedia bagi pengguna
    public function jenisIbadahTersedia()
    {
        return JenisIbadah::query()
            ->where(function ($query) {
                $query->whereNull('user_id')
                    ->orWhere('user_id', $this->id);
            });
    }

    // Relasi statistik ibadah pengguna
    public function statistikIbadah(): HasMany
    {
        return $this->hasMany(StatistikIbadah::class);
    }

    // Relasi streak yang diikuti pengguna
    public function streaks(): BelongsToMany
    {
        return $this->belongsToMany(
            Streak::class,
            'streak_anggota',
            'user_id',
            'streak_id'
        );
    }

    // Relasi notifikasi yang diterima pengguna
    public function notifikasiDiterima(): HasMany
    {
        return $this->hasMany(Notifikasi::class, 'penerima_id');
    }

    // Relasi notifikasi yang dikirim pengguna
    public function notifikasiDikirim(): HasMany
    {
        return $this->hasMany(Notifikasi::class, 'pengirim_id');
    }
}
