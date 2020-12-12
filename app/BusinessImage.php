<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class BusinessImage extends Model
{
    protected $fillable = ['business_id', 'image_id'];
}
