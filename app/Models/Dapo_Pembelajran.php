<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Dapo_Pembelajran extends Model
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

    public function Dapo_GTK(): HasMany {
        return $this->hasMany(Dapo_GTK::class, "ptk_id", "ptk_id");
    }
}
