<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class MapingKelas extends Model
{
    use HasFactory;
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];



    public function Siswa(): HasOne
    {
        return $this->hasOne(Siswa::class, "peserta_didik_id", "peserta_didik_id");
    }

    function Kelas(): BelongsTo
    {
        return $this->belongsTo(kelas::class, "rombongan_belajar_id", "rombongan_belajar_id");
    }
}
