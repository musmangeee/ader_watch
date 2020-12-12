<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $fillable = ['name', 'description', 'price', 'amount_per_view', 'total_views'];
}
