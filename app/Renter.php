<?php

namespace App;

use App\Scopes\RenterScope;

class Renter extends User
{
    protected $table = 'users';
    
    public static function boot()
    {
        parent::boot();
        static::addGlobalScope(new RenterScope);
    }
}
