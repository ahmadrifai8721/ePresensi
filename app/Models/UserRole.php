<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class UserRole extends Model
{
    use HasFactory;
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    function User(): HasOne
    {
        return $this->hasOne(User::class, "id", "user_id");
    }
    function Role(): HasOne
    {
        return $this->hasOne(Role::class, "id", "role_id");
    }
}
