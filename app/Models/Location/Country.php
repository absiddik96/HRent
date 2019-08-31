<?php

namespace App\Models\Location;

use App\Models\HouseLocation;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = ['country', 'slug'];

    public function setCountryAttribute($value)
    {
        $this->attributes['country'] = strtolower($value);
        $this->attributes['slug'] =  str_slug($value);
    }

    public function divisions()
    {
        return $this->hasMany(Division::class);
    }

    public function cities()
    {
        return $this->hasMany(City::class);
    }

    public function policeStations()
    {
        return $this->hasMany(PoliceStation::class);
    }

    public function villages()
    {
        return $this->hasMany(Village::class);
    }

    public function words()
    {
        return $this->hasMany(Word::class);
    }

    public function houseLocations()
    {
        return $this->hasMany(HouseLocation::class);
    }

}
