<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SalesDetail extends JsonResource
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

            'purchaseCloudId' => $this->order_id,
            'vatCloudId' => $this->payment_contract_id,
            'itemCloudId' => $this->location_id,

            'itemDescription' => $this->description,
            'cost' => $this->cost,
            'quantity' => $this->quantity,
            'price' => $this->price,

            'updatedAt' => $this->updated_at,
        ];
    }
}
