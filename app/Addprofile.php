<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Addprofile extends Model
{
    protected $fillable =['user_id','user_name','user_email','slug_id','slugname',
    'u_org_role_id','country_id', 'state_id', 'city_id','mobile', 'facebook','twitter',
    'youtube','wordpress','tumblr','instagram','quora','pinterest','reddit','koo','scoopit','slashdot'];
}
