<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Verifytoken extends Model
{
    protected $fillable =['email','token'];
}
