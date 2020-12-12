<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'address', 'town_id', 'dob'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'provider_name', 'provider_id', 'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function business()
    {
        return $this->hasOne('App\Business', 'user_id');
    }

    public function reviews()
    {
        return $this->hasMany('App\Review', 'user_id');
    }

    public function city()
    {
        return $this->hasOne('App\City', 'id', 'city_id');
    }

    public function claim()
    {
        return $this->hasOne('App\BusinessClaim');
    }
}
