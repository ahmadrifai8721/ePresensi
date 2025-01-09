<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Dapo_Pengguna extends Model
{
    use HasFactory;
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    public function Guru(): HasOne
    {
        return $this->hasOne(Guru::class, "ptk_id", "ptk_id");
    }
    public function Siswa(): HasOne
    {
        return $this->hasOne(Siswa::class, "peserta_didik_id", "peserta_didik_id");
    }
}
