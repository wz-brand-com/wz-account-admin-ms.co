<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organisation extends Model
{
    protected $fillable =['org_user_id','org_name','org_slug','org_user_email','org_user_name'];
}
