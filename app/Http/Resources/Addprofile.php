<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Addprofile extends JsonResource
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
            'id' => $this->id,
            'admin_id' => $this->admin_id,
            'user_name' => $this->user_name,
            'admin_email' => $this->admin_email,
            'slug_id' => $this->slug_id,
            'slugname' => $this->slugname,
            'u_org_role_id' => $this->u_org_role_id,
            'facebook' => $this->facebook,
            'twitter' => $this->twitter,
            'youtube' => $this->youtube,
            'wordpress' => $this->wordpress,
            'tumblr' => $this->tumblr,
            'instagram' => $this->instagram,
            'quora' => $this->quora,
            'pinterest' => $this->pinterest,
            'reddit' => $this->reddit,
            'koo' => $this->koo,
            'scoopit' => $this->scoopit,
            'slashdot' => $this->slashdot,
        ];
    }
}
