<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Guru extends Model
{
    use HasFactory;
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    function Dapo_Pengguna(): HasOne
    {
        return $this->hasOne(Dapo_Pengguna::class, "ptk_id", "ptk_id");
    }
    function Dapo_GTK(): HasOne
    {
        return $this->hasOne(Dapo_GTK::class, "ptk_id", "ptk_id");
    }
    function User(): BelongsTo
    {
        return $this->belongsTo(User::class, "user_id", "id");
    }

    public function Kelas(): HasOne
    {
        return $this->hasOne(Kelas::class, "waliKelas", "id");
    }
    function presensi(): HasMany
    {
        return $this->hasMany(presensiGuru::class, "guru", "ptk_id");
    }
    function pembelajaran(): HasMany
    {
        return $this->hasMany(Pembelajaran::class, "guruMapel", "id");
    }
}
