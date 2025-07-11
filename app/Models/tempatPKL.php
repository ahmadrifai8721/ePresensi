<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tempatPKL extends Model
{
    use HasFactory;

    protected $guarded = ["id"];

    public function mapingpkl()
    {
        return $this->hasMany(MapingPKL::class, "tempat_p_k_l_id", "id");
    }
    public function penanggungJawab()
    {
        return $this->belongsTo(Guru::class, "penanggung_jawab");
    }
}
