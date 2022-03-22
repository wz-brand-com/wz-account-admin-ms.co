<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Usersorganization extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=> $this->id,
            'invited_by'=> $this->invited_by,
            'u_org_role_id' => $this->u_org_role_id,
            'u_org_role_name' => $this->u_org_role_name,
            'u_org_organization_id'=> $this->u_org_organization_id,
            'status'=> $this->status,
            'invited_removed'=> $this->invited_removed,
            'invited_by_email'=> $this->invited_by_email,
            'u_org_user_email'=> $this->u_org_user_email,
            'u_org_user_id'=> $this->u_org_user_id,
        ];
    }
}
