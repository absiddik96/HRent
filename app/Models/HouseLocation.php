<?php

namespace App\Models;

use App\Models\Location\City;
use App\Models\Location\Word;
use App\Models\Location\Village;
use App\Models\Location\Country;
use App\Models\Location\Division;
use App\Models\Location\PoliceStation;
use Illuminate\Database\Eloquent\Model;

class HouseLocation extends Model
{
    protected $fillable = ['house_id', 'country_id', 'division_id', 'city_id', 'police_station_id', 'village_id', 'word_id'];

    public function house()
    {
        return $this->belongsTo(HouseInfo::class, 'id', 'house_id');
    }

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

    public function village()
    {
        return $this->belongsTo(Village::class);
    }

    public function word()
    {
        return $this->belongsTo(Word::class);
    }
}
