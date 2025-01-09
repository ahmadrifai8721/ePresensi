<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Dapo_Rombel extends Model
{
    use HasFactory;
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    public function Dapo_PD(): HasMany
    {
        return $this->hasMany(Dapo_PD::class, "rombongan_belajar_id", "rombongan_belajar_id");
    }

    public function Siswa(): HasMany
    {
        return $this->hasMany(Siswa::class, "rombongan_belajar_id", "rombongan_belajar_id");
    }

    public function Dapo_Pembelajran(): HasMany
    {
        return $this->hasMany(Dapo_Pembelajran::class, "rombongan_belajar_id", "rombongan_belajar_id");
    }

    public function Dapo_GTK(): HasMany
    {
        return $this->hasMany(Dapo_GTK::class, "rombongan_belajar_id", "rombongan_belajar_id");
    }

    public function Dapo_Jurusan(): HasMany
    {
        return $this->hasMany(Dapo_Jurusan::class, "id", "jurusan_id_str");
    }
}
