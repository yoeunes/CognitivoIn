<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class APIPointOfSale extends JsonResource
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

            'name' => $this->name,

            'defaultPriceList' => $this->default_price_list,
            'defaultPaymentCondition' => $this->default_payment_condition,
            'defaultPaymentType' => $this->default_payment_type,

            'isRestaurant' => $this->is_restaurant,
            'isTaxInclusive' => $this->is_tax_inclusive,

            'useTouchScreen' => $this->use_touchscreen,
            'useLoyaltyProgram' => $this->use_loyalty_program,
            'useCashControl' => $this->use_cash_control,

            'updatedAt' => $this->updated_at,
        ];
    }
}
