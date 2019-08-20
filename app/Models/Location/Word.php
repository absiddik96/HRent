<?php

namespace App\Models\Location;

use App\Models\HouseLocation;
use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
    protected $fillable = ['country_id', 'division_id', 'city_id', 'police_station_id', 'word', 'slug'];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function policeStation()
    {
        return $this->belongsTo(PoliceStation::class);
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
