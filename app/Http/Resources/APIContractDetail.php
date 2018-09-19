<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class APIContractDetail extends JsonResource
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
      'localId' =>$this->localId
      'cloud_id' => $this->id,
      'percent' => $this->percent,
      'offset' => $this->offset,
      'updatedAt' => $this->updated_at,
    ];
  }
}
