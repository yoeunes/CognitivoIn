<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Range extends JsonResource
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

            'startingValue' => $this->starting_value,
            'currentValue' => $this->current_value,
            'endingValue' => $this->ending_value,
            'template' => $this->template,
            'mask' => $this->mask,
            'code' => $this->code,

            'expiryDate' => $this->expiry_date,
            'updatedAt' => $this->updated_at,
        ];
    }
}
