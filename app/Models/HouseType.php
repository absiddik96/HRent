<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HouseType extends Model
{
    protected $fillable = ['name', 'slug'];

    public function houseInfo()
    {
        return $this->hasMany(HouseInfo::class);
    }
}
