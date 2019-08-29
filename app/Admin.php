<?php

namespace App;

use App\Models\UserRole;
use App\Scopes\AdminScope;

class Admin extends User
{
    protected $table = 'users';

    public static function boot()
    {
        parent::boot();
        static::addGlobalScope(new AdminScope);
    }

    public static function role()
    {
        return UserRole::where('role','admin')->first()->id;
    }
}
