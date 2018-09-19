<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class APICustomer extends JsonResource
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

            'name' => $this->customer_name,
            'alias' => $this->customer_alias,
            'taxId' => $this->customer_taxid,
            'address' => $this->customer_address,
            'telephone' => $this->customer_telephone,
            'email' => $this->customer_email,

            'creditLimit' => $this->credit_limit,
            'leadTime' => $this->lead_time,

            'updatedAt' => $this->updated_at,
        ];
    }
}
