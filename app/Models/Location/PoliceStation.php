<?php

namespace App\Models\Location;

use App\Models\HouseLocation;
use Illuminate\Database\Eloquent\Model;

class PoliceStation extends Model
{
    protected $fillable = ['country_id', 'division_id', 'city_id', 'police_station', 'slug'];

    protected $with = ['country','division','city'];

    public function setPoliceStationAttribute($value)
    {
        $this->attributes['police_station'] = strtolower($value);
        $this->attributes['slug'] = str_slug($value);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function division()
    {
        return $this->belongsTo(Division::class)->without(['country']);
    }

    public function city()
    {
        return $this->belongsTo(City::class)->without(['country','division']);
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
