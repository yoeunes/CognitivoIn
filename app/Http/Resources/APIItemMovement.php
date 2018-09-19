<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class APIItemMovement extends JsonResource
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
            'date' => $this->date,
            'debit' => $this->debit,
            'credit' => $this->credit,
            'comment' => $this->comment,

            'updatedAt' => $this->updated_at,
        ];
    }
}
