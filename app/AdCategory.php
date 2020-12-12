<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdCategory extends Model
{
    //
    protected $fillable = ['id' ,'ad_id'];
    public function ads()
    {
        return $this->hasMany('App\Ads');
    }
}
