<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
