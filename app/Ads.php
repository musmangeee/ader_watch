<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ads extends Model
{
    protected $fillable = ['business_id' ,'package_id','title','description','featured','video','video_duration','link','btn_text'];

    public function package()
    {
        return $this->hasOne('App\Package', 'id', 'package_id');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Category', 'ad_categories', 'ad_id', 'category_id');
    }

    public function business()
    {
        return $this->hasOne('App\Business', 'id', 'package_id');
    }
}
