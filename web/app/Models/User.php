<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class User extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'users';
    
    protected $fillable = [
        'username', 'password', 'email', 'name', 'role_id', 'gender', 'address'
    ];
}
