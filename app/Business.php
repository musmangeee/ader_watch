<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    protected $table = 'businesses';

    protected $fillable = ['id', 'name', 'url',
        'phone', 'city_id', 'address', 'images', 'created_by', 'updated_by', 'deleted_by', 'user_id', 'slug', 'town_id'];

    public function categories()
    {
        return $this->belongsToMany('App\Category', 'business_categories', 'business_id', 'category_id');
    }

    public function reviews()
    {
        return $this->hasMany('App\Review');
    }

    public function town()
    {
        return $this->hasOne('App\Town', 'id', 'town_id');
    }

    public function city()
    {
        return $this->hasOne('App\City', 'id', 'city_id');
    }

    public function images()
    {
        return $this->belongsToMany('App\Image', 'business_images', 'business_id', 'image_id');
    }


    public function ads()
    {
        return $this->hasMany('App\Ads');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
