<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class APIItemResource extends JsonResource
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
            'cloud_id' => $this->id,
            'name' => $this->name,
            'code' => $this->name,
            'description' => $this->name,
            'price' => $this->name,
            'local_id' => $this->ref_id,
            'vat_cloud_id' => $this->vat_id
            
        ];
    }
}
