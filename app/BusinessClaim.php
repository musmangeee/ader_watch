<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusinessClaim extends Model
{
    protected $fillable = ['role', 'business_id','user_id', 'email_username'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function business()
    {
        return $this->belongsTo('App\Business');
    }
}
