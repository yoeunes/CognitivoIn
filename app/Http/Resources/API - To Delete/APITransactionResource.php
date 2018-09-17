<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class APITransactionResource extends JsonResource
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
            'relationship_id' => $this->relationship_id,
            'local_id' => $this->ref_id,
            'details' => $this->details->transform(function($page){
                return [
                    'cloud_id' => $page->id,
                    'item_id' => $page->item_id,
                    'quantity' => $page->quantity,
                    'unit_price' => $page->unit_price,
                ];
            }),
        ];
    }
}
