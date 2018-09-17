<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Supplier extends JsonResource
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

            'name' => $this->supplier_alias,
            'taxId' => $this->supplier_taxid,
            'address' => $this->supplier_address,
            'telephone' => $this->supplier_telephone,
            'email' => $this->supplier_email,
            
            'leadTime' => $this->lead_time,
            'creditLimit' => $this->credit_limit,

            'updatedAt' => $this->updated_at,
        ];
    }
}
