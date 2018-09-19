<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class APIItem extends JsonResource
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
            'localId' => $this->ref_id,
            'cloudId' => $this->id,

            'name' => $this->name,
            'sku' => $this->sku,
            'barCode' => $this->barcode,
            'vatId' => $this->vat_id,
            'currencyCode' => $this->currency,
            'price' => $this->price??0,
            'cost' => $this->cost??0,
            'weighWithScale' => $this->weigh_with_scale??0,
            'weight' => $this->weight??0,
            'volume' => $this->volume??0,
            'updatedAt' => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}
