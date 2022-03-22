<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usersorganization extends Model
{
    protected $fillable =['u_org_user_id','u_org_role_id','u_org_role_name','u_org_organization_id','status','u_org_slugname','invited_by','invited_by_email','u_org_user_email','invited_removed','u_org_user_name'];
}
