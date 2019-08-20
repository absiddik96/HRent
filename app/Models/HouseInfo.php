<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class HouseInfo extends Model
{
    const STATUS = [
        'Deactive' => 0,
        'Active' => 1,
    ];

    const IS_APPROVED = [
        'Unapproved' => 0,
        'Approved' => 1,
    ];

    protected $fillable = [
        'user_id', 'house_type_id', 'title', 'house_address', 'house_token', 'status', 'is_approved',
    ];

    protected $appends = [
        'approval'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function houseType()
    {
        return $this->belongsTo(HouseType::class);
    }

    public function houseDetails()
    {
        return $this->hasOne(HouseDetails::class, 'house_id', 'id');
    }

    public function houseImages()
    {
        return $this->hasMany(HouseImage::class, 'house_id', 'id');
    }

    public function houseLocation()
    {
        return $this->hasOne(HouseLocation::class, 'house_id', 'id');
    }

    public function getApprovalAttribute()
    {
        return array_search($this->approved, self::IS_APPROVED);
    }
}
