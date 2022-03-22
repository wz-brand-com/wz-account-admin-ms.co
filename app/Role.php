<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use User;

class Role extends Model
{
    public function user()
    {
        return $this->hasMany('App\User');
    }
}
