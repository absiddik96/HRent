<?php

namespace App;

use App\Scopes\LandlordScope;

class Landlord extends User
{
    protected $table = 'users';
    
    public static function boot()
    {
        parent::boot();
        static::addGlobalScope(new LandlordScope);
    }
}
