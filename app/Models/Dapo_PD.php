<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Dapo_PD extends Model
{
    use HasFactory;
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    public function Dapo_Rombel(): HasOne
    {
        return $this->hasOne(Dapo_Rombel::class, "rombongan_belajar_id", "rombongan_belajar_id");
    }

    public function Dapo_Pengguna(): HasMany
    {
        return $this->HasMany(Dapo_Pengguna::class, "peserta_didik_id", "peserta_didik_id");
    }
    public function Siswa(): HasOne
    {
        return $this->hasOne(Siswa::class, "peserta_didik_id", "peserta_didik_id");
    }

    function Kelas(): HasOne
    {
        return $this->hasOne(Kelas::class, "rombongan_belajar_id", "rombongan_belajar_id");
    }
    public function User(): BelongsTo
    {
        return $this->BelongsTo(User::class, "dapo_id", "peserta_didik_id");
    }
}
