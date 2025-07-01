<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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

    public function User(): HasOne
    {
        return $this->hasOne(User::class, "id", "user_id");
    }
    public function Dapo_GTK(): BelongsTo
    {
        return $this->BelongsTo(Dapo_GTK::class, "ptk_id", "ptk_id");
    }
    public function Dapo_PD(): BelongsTo
    {
        return $this->BelongsTo(Dapo_PD::class, "peserta_didik_id", "peserta_didik_id");
    }
    public function Guru(): HasOne
    {
        return $this->hasOne(Guru::class, "ptk_id", "ptk_id");
    }
    public function Siswa(): HasOne
    {
        return $this->hasOne(Siswa::class, "peserta_didik_id", "peserta_didik_id");
    }
}
