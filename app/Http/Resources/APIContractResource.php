<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class APIContractResource extends JsonResource
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
            'name' => $this->name,
            'local_id' => $this->ref_id,
            'details' => $this->details->transform(function($page){
                return [
                    'cloud_id' => $page->id,
                    'percent' => $page->percent,
                    'offset' => $page->offset,
                ];
            }),
        ];
    }
}
