<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\PaymentContractDetail as PaymentContractDetailResource;

class PaymentContract extends JsonResource
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
            'details' => PaymentContractDetailResource::collection($this->whenLoaded('details')),

            'updatedAt' => $this->updated_at,
        ];
    }
}
