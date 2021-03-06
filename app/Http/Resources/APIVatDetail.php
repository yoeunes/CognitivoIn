<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class APIVatDetail extends JsonResource
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
             'coefficient' => $this->coefficient,
             'percentage' => $this->percentage,

             'updatedAt' => $this->updated_at,
         ];
    }
}
