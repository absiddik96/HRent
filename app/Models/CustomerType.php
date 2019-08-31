<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerType extends Model
{
    protected $fillable = ['type', 'slug'];

    public function setTypeAttribute($value)
    {
        $this->attributes['type'] = strtolower($value);
        $this->attributes['slug'] =  str_slug($value);
    }

}
