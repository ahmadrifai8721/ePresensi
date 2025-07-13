<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\tempatPKL;

class PresensiPKLModel extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function siswa(): BelongsTo
    {
        return $this->belongsTo(Siswa::class);
    }
    public function tempat(): BelongsTo
    {
        return $this->belongsTo(tempatPKL::class, "tempat_p_k_l_id", "id");
    }
}
