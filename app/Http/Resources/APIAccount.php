<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Account as AccountResource;
class APIAccount extends JsonResource
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
            'number' => $this->email,
            'currencyCode' => $this->currency,
            'updatedAt' => $this->updated_at,
        ];
    }
}
