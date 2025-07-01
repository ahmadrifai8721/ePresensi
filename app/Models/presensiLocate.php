<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class presensiLocate extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function presensi(): HasOne
    {
        return $this->hasOne(presensi::class, 'id', 'presensi_id');
    }
    public function presensiGuru(): HasOne
    {
        return $this->hasOne(presensiGuru::class, 'id', 'presensi_guru_id');
    }
}
