<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class presensiGuru extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];
    public function kelas(): HasOne
    {
        return $this->hasOne(kelas::class, 'id', 'kelas_id');
    }
    public function Guru(): HasOne
    {
        return $this->hasOne(Guru::class, 'ptk_id', 'guru');
    }
    public function pembelajaran(): HasOne
    {
        return $this->hasOne(pembelajaran::class, 'pembelajaran_id', 'maple');
    }
    public function presensiSiswaMapel(): HasMany
    {
        return $this->hasMany(presensiSiswaMapel::class, 'presensi_guru_id', 'id');
    }
    public function presensiLocate(): HasMany
    {
        return $this->hasMany(presensiLocate::class, 'presensi_id', 'id');
    }
}
