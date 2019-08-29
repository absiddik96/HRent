<?php

namespace App;

use App\Models\UserRole;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /* set status */
    const ACTIVE = true;
    const DEACTIVE = false;

    /* set admin */
    const VERIFIED = true;
    const UNVERIFIED = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'user_role_id', 'status', 'is_verified',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = [
        'user_status', 'verified', 'user_role'
    ];

    public function user_role()
    {
        return $this->belongsTo(UserRole::class);
    }

    public function userPersonalInfo()
    {
        return $this->hasOne(UserPersonalInfo::class);
    }

    public function houseInfo()
    {
        return $this->hasOne(HouseInfo::class);
    }

    protected function getUserStatusAttribute()
    {
        if ($this->status == 0) {
            return 'DEACTIVE';
        } elseif ($this->status == 1) {
            return 'ACTIVE';
        } else {
            return '';
        }
    }

    protected function getVerifiedAttribute()
    {
        if ($this->is_verified == 0) {
            return 'UNVERIFIED';
        } elseif ($this->is_verified == 1) {
            return 'VERIFIED';
        } else {
            return '';
        }
    }

    protected function getUserRoleAttribute()
    {
        return UserRole::findOrFail($this->user_role_id)->role;
    }
}
