<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Dapo_GTK extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    public function User()
    {
        return $this->belongsTo(User::class, 'dapo_id', 'ptk_id');
    }

    function Guru(): BelongsTo
    {
        return $this->belongsTo(Guru::class, "ptk_id", "prk_id");
    }
    function Dapo_Pengguna(): HasMany
    {
        return $this->HasMany(Dapo_Pengguna::class, "ptk_id", "ptk_id");
    }
}
    