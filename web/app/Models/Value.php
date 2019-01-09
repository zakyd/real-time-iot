<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Value extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'values';
    
    protected $fillable = [
        'humidity', 'temperature'
    ];
}
