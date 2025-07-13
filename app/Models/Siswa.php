<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Siswa extends Model
{
    use HasFactory;
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];


    public function mapingKelas(): HasMany
    {
        return $this->hasMany(MapingKelas::class, "peserta_didik_id", "peserta_didik_id");
    }

    public function mapingPKL(): HasOne
    {
        return $this->hasOne(MapingPKL::class);
    }

    function User(): HasOne
    {
        return $this->hasOne(User::class, "id", "user_id");
    }
    function Dapo_Pengguna(): HasOne
    {
        return $this->hasOne(Dapo_Pengguna::class, "peserta_didik_id", "peserta_didik_id");
    }

    function presensi(): HasMany
    {
        return $this->hasMany(presensi::class, "siswa_id", "id");
    }
    function presensiMapel(): HasMany
    {
        return $this->hasMany(presensiSiswaMapel::class, "siswa_id", "id");
    }
    function presensiPKL(): HasMany
    {
        return $this->hasMany(PresensiPKLModel::class, "siswa_id", "id");
    }
}
