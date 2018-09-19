<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\APISalesDetail as SalesDetailResource;

class APISales extends JsonResource
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

            'locationCloudId' => $this->location_id,
            'paymentContractCloudId' => $this->payment_contract_id,
            'customerCloudId' => $this->relationship_id,

            'date' => $this->date,
            'status' => $this->status,

            'InvoiceNumber' => $this->number,
            'InvoiceCode' => $this->code,

            'currencyCode' => $this->currency,
            'currencyRate' => $this->rate,

            'details' => SalesDetailResource::collection($this->whenLoaded('details')),

            'isArchived' => $this->is_archived,
            'updatedAt' => $this->updated_at,
        ];
    }
}
