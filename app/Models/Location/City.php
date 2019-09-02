<?php

namespace App\Models\Location;

use App\Models\HouseLocation;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = ['country_id', 'division_id', 'city', 'slug'];

    protected $with = ['country','division'];

    public function setCityAttribute($value)
    {
        $this->attributes['city'] = strtolower($value);
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

    public function policeStaions()
    {
        return $this->hasMany(PoliceStation::class);
    }

    public function words()
    {
        return $this->hasMany(Word::class);
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
