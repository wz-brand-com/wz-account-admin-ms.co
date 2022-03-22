<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
       'u_org_user_id','u_org_slugname','u_org_user_email', 'u_org_organization_id', 'facebook', 'linkedIn', 'twitter', 'instagram', 'youtube','pinterest','reddit','tumblr','plurk','getpocket','projectname'
    ];
}
