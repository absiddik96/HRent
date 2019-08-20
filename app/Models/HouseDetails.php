<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HouseDetails extends Model
{
    protected $fillable = [
        'house_id', 'bed_room', 'wash_room', 'porches', 'drawing_room', 'dining_room', 'store_room', 'rent_amount',
    ];

    public function houseInfo()
    {
        return $this->belongsTo(HouseInfo::class, 'id', 'house_id');
    }
}
