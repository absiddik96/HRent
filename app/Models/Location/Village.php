<?php

namespace App\Models\Location;

use App\Models\HouseLocation;
use Illuminate\Database\Eloquent\Model;

class Village extends Model
{
    protected $fillable = ['country_id', 'division_id', 'city_id', 'police_station_id', 'word_id', 'village', 'slug'];

    protected $with = ['country','division','city','policeStation','word'];

    public function setVillageAttribute($value)
    {
        $this->attributes['village'] = strtolower($value);
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

    public function word()
    {
        return $this->belongsTo(Word::class)->without(['country','division','city','policeStation']);
    }

    public function houseLocations()
    {
        return $this->hasMany(HouseLocation::class);
    }

}
