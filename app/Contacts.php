<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\Factories\HasFactory; 



class Contacts extends Model
{
    // use HasFactory; 

    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'message'
    ];
}
