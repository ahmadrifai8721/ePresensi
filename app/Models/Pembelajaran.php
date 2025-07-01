<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Pembelajaran extends Model
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
        return $this->hasOne(kelas::class, "id", "kelas_id");
    }

    public function guru(): HasOne
    {
        return $this->hasOne(Guru::class, "id", "guruMapel");
    }
    public function presensiGuru(): HasOne
    {
        return $this->hasOne(presensiGuru::class, "maple", "pembelajaran_id");
    }
}
