<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Relationship;
use App\Profile;

class Cart extends Model
{
    public function scopeFromCustomers($query)
    {
        return $query->join('relationships', 'relationships.id', 'carts.relationship_id')
        ->where('relationships.supplier_id', request()->route('profile')->id);
    }

    public function scopeToSuppliers($query)
    {
        return $query->join('relationships', 'relationships.id', 'carts.relationship_id')
        ->where('relationships.customer_id', request()->route('profile')->id);
    }

    public function relationship()
    {
        return $this->belongsTo(Relationship::class);
    }

}
