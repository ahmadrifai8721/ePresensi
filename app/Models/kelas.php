<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class kelas extends Model
{
    use HasFactory;
    protected $fillable = [
        'kelas',
        'waliKelas',
        'rombongan_belajar_id',
        'tingkat',
        'jurusan',
    ];

    protected $primaryKey = 'kelas';
    public $incrementing = false;
    public function Guru(): HasOne
    {
        return $this->hasOne(Guru::class, "id", "waliKelas");
    }

    function mapingKelas(): HasMany
    {
        return $this->hasMany(MapingKelas::class, "rombongan_belajar_id", "rombongan_belajar_id");
    }
    function Pembelajaran(): HasMany
    {
        return $this->hasMany(Pembelajaran::class, "kelas_id", "id");
    }

    public function PresensiSiswa(): HasMany
    {
        return $this->hasMany(presensi::class, 'kelas_id', 'id');
    }
    public function PresensiGuru(): HasMany
    {
        return $this->hasMany(presensiGuru::class, 'kelas_id', 'id');
    }
}
