<?php

namespace App\Models\Location;

use App\Models\HouseLocation;
use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
    protected $fillable = ['country_id', 'division_id', 'city_id', 'police_station_id', 'word_no', 'slug'];

    protected $with = ['country','division','city','policeStation'];

    public function setWordNoAttribute($value)
    {
        $this->attributes['word_no'] = strtolower($value);
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

    public function policeStation()
    {
        return $this->belongsTo(PoliceStation::class)->without(['country','division','city']);
    }

    public function villages()
    {
        return $this->hasMany(Village::class);
    }

    public function houseLocations()
    {
        return $this->hasMany(HouseLocation::class);
    }

}
