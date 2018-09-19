<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class APILocation extends JsonResource
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
            'localId' => $this->localId,
            'cloudId' => $this->id,

            'name' => $this->name,
            'address' => $this->address,
            'telephone' => $this->telephone,
            'email' => $this->email,
            'vatCloudId' => $this->vat_id,
            'currencyCode' => $this->currency,

            'updatedAt' => $this->updated_at,
        ];
    }
}
