<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class APICustomerResource extends JsonResource
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
            'name' => $this->customer_alias,
            'code' => $this->customer_taxid,
            'address' => $this->customer_address,
            'telephone' => $this->customer_telephone,
            'local_id' => $this->ref_id,
            'email' => $this->customer_email
            }),
        ];
    }
}
