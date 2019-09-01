<?php

namespace App\Models\Location;

use App\Models\HouseLocation;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    protected $fillable = ['country_id', 'division', 'slug'];

    protected $with = ['country'];

    public function setDivisionAttribute($value)
    {
        $this->attributes['division'] = strtolower($value);
        $this->attributes['slug'] = str_slug($value);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
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
