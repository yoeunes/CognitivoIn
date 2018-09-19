<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class APIPaymentType extends JsonResource
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

            'behaviour' => $this->behaviour,

            'name' => $this->name,
            'icon' => $this->icon,
            'updatedAt' => $this->updated_at,
        ];
    }
}
