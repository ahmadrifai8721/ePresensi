<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
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
    function Siswa(): HasOne
    {
        return $this->hasOne(Siswa::class, "user_id", "id");
    }
    function Guru(): HasOne
    {
        return $this->hasOne(Guru::class, "user_id", "id");
    }
    function UserRole(): HasOne
    {
        return $this->hasOne(UserRole::class, "user_id", "id");
    }
}
