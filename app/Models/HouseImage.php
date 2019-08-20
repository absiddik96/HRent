<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HouseImage extends Model
{
    const UPLOAD_PATH = '/uploads/house_images';
    const THUMB_UPLOAD_PATH = '/uploads/house_images/thumbnail';

    protected $fillable = ['house_id', 'image',];

    public function houseInfo()
    {
        return $this->belongsTo(HouseInfo::class, 'id', 'house_id');
    }

    public function getImageUrlAttribute()
    {
        return asset(self::THUMB_UPLOAD_PATH.'/'.$this->image);
    }

    public function getThumbAttribute()
    {
        return asset(self::THUMB_UPLOAD_PATH.'/'.$this->image);
    }
}
