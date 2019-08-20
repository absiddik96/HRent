<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class UserPersonalInfo extends Model
{
    protected $fillable = [
        'user_id', 'phone', 'image', 'identity_proof', 'identity_proof_type',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getImageAttribute($value)
    {
        return asset('uploads/users/avatar/'. $value);
    }

    public function getIdentityProofAttribute($value)
    {
        return asset('uploads/users/identity_proof/'. $value);
    }

    protected $appends = [
        'identity_scan'
    ];

    protected function getIdentityScanAttribute()
    {
        if ($this->identity_proof_type == 0) {
            return 'National ID Card';
        } elseif ($this->identity_proof_type == 1) {
            return 'Passport';
        } elseif ($this->identity_proof_type == 2) {
            return 'Birth Certificate';
        }
    }
}