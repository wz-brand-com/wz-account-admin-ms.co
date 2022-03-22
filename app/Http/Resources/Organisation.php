<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Organisation extends JsonResource
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
            'org_slug'=> $this->org_slug,
            'org_name'=> $this->org_name,
            'org_user_name'=> $this->org_user_name
        ]; 
    }
}
