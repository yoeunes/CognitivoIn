<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class APIItemPriceList extends JsonResource
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
            'startDate' => $this->start_date,
            'endDate' => $this->end_date,

            'inputType' => $this->input_type,
            'inputReference' => $this->input_reference,
            'inputValue' => $this->input_value,

            'outputType' => $this->output_type,
            'outputReference' => $this->output_reference,
            'outputValue' => $this->output_value,

            'updatedAt' => $this->updated_at,
        ];
    }
}
