<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class View extends Model
{
    protected $fillable = ['user_id', 'ad_id', 'reward', 'status'];
}
