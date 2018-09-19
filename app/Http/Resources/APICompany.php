<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class APICompany extends JsonResource
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
            'slugCognitivo' => $this->slug,

            'name' => $this->name,
            'taxId' => $this->taxid,
            'address' => $this->address,
            'telephone' => $this->telephone,
            'email' => $this->email,
            'currencyCode' => $this->currency,

            'updatedAt' => $this->updated_at,
        ];
    }
}
