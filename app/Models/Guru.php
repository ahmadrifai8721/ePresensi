<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
    function User(): BelongsTo
    {
        return $this->belongsTo(User::class, "id", "user_id");
    }

    public function Kelas(): BelongsTo
    {
        return $this->belongsTo(Kelas::class, "waliKelas", "id");
    }
}
