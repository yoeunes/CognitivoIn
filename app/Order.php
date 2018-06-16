<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\OrderDetail;
use App\Relationship;

class Order extends Model
{
    protected $table = 'orders';

    public function scopemySales($query)
    {
        return $query->join('relationships', 'relationships.id', 'orders.relationship_id')
        ->where('relationships.supplier_id', request()->route('profile')->id);
    }

    public function scopemyPurchases($query)
    {
        return $query->join('relationships', 'relationships.id', 'orders.relationship_id')
        ->where('relationships.customer_id', request()->route('profile')->id);
    }

    public function details()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function relationship()
    {
        return $this->belongsTo(Relationship::class,'id');
    }
}
