<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\APIVatDetail as VatDetailResource;

class APIVat extends JsonResource
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
          'details' => VatDetailResource::collection($this->whenLoaded('details')),

          'updatedAt' => $this->updated_at,
      ];
    }
}
