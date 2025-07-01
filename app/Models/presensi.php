<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class presensi extends Model
{
    use HasFactory;

    protected $fillable = [
        'siswa_id',
        'kelas_id',
        'presensi',
        'tanggal',
    ];

    protected $primaryKey = 'siswa_id';

    public function User(): HasOne
    {
        return $this->hasOne(Siswa::class, 'id', 'siswa_id');
    }

    public function Kelas(): HasOne
    {
        return $this->hasOne(kelas::class, 'id', "kelas_id");
    }
    public function presensiLocate(): BelongsTo
    {
        return $this->BelongsTo(presensiLocate::class, 'presensi_id', 'id');
    }
}
