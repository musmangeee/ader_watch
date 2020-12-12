<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = ['ad_id', 'user_id', 'text', 'stars'];

    public function business()
    {
        return $this->belongsTo('App\Business');
    }

    public function images()
    {
        return $this->belongsToMany('App\Image', 'review_images', 'review_id', 'image_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }


}
