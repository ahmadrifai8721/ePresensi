<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class presensiSiswaMapel extends Model
{
    use HasFactory;

    use HasFactory;
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    public function presensiGuru(): HasOne
    {
        return $this->hasOne(presensiGuru::class, "id", "presensi_guru_id");
    }
    public function User(): HasOne
    {
        return $this->hasOne(Siswa::class, 'id', 'siswa_id');
    }
}
