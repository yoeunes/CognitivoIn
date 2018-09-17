<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Item extends JsonResource
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
            'sku' => $this->sku,
            'barCode' => $this->barcode,
            'vatId' => $this->vat_id,
            'currencyCode' => $this->currency,
            'price' => $this->price,
            'cost' => $this->cost,
            'weighWithScale' => $this->weigh_with_scale,
            'weight' => $this->weight,
            'volume' => $this->volume,
            'updatedAt' => $this->updated_at,
        ];
    }
}
