<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
        'email',
        'dapo_id',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        // 'password' => 'hashed',
    ];

    public function kelas()
    {
        return $this->hasOne(kelas::class, 'id', 'kelas_id');
    }
    public function presensi()
    {
        return $this->hasMany(kelas::class, 'user_id', 'id');
    }
    public function Siswa(): HasOne
    {
        return $this->hasOne(Siswa::class, "user_id", "id");
    }
    public function Guru(): HasOne
    {
        return $this->hasOne(Guru::class, "user_id", "id");
    }
    public function UserRole(): HasOne
    {
        return $this->hasOne(UserRole::class, "user_id", "id");
    }
    public function mobileAccess(): HasOne
    {
        return $this->hasOne(MobileAccess::class, "user_id", "id");
    }

    public function dapo_g_t_k(): HasOne
    {
        return $this->hasOne(Dapo_GTK::class, "ptk_id", "dapo_id");
    }
    public function dapo_pd(): HasOne
    {
        return $this->hasOne(Dapo_PD::class, "peserta_didik_id", "dapo_id");
    }
}
