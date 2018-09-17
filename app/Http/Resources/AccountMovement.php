<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AccountMovement extends JsonResource
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

            'account' => AccountResource::collection($this->whenLoaded('account')),

            'date' => $this->date,
            'debit' => $this->debit,
            'credit' => $this->credit,
            'currencyCode' => $this->currency,
            'currencyRate' => $this->rate,
            'comment' => $this->comment,

            'updatedAt' => $this->updated_at,
        ];
    }
}
