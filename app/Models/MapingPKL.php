<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MapingPKL extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }

    public function tempat()
    {
        return $this->belongsTo(tempatPKL::class, 'tempat_p_k_l_id', 'id');
    }
}
