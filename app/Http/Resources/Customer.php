<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Customer extends JsonResource
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

            'name' => $this->customer_alias,
            'taxId' => $this->customer_taxid,
            'address' => $this->customer_address,
            'telephone' => $this->customer_telephone,
            'email' => $this->customer_email,

            'leadTime' => $this->lead_time,

            'updatedAt' => $this->updated_at,
        ];
    }
}
