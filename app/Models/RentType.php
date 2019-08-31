<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RentType extends Model
{
    protected $fillable = ['name', 'slug'];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = strtolower($value);
        $this->attributes['slug'] =  str_slug($value);
    }
}
