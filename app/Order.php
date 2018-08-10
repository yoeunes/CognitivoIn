<?php

namespace App;
use Spatie\ModelStatus\HasStatuses;
use Illuminate\Database\Eloquent\Model;
use App\OrderDetail;
use App\Relationship;

class Order extends Model
{
  use HasStatuses;
    protected $table = 'orders';

    public function scopemySales($query)
    {
        return $query
        ->with('relationship')
        ->whereHas('relationship', function($q)
        { $q->where('supplier_id', request()->route('profile')->id); });
    }

    public function scopemyPurchases($query)
    {
        return $query
        ->with('relationship')
        ->whereHas('relationship', function($q)
        { $q->where('customer_id', request()->route('profile')->id); });
    }

    public function details()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function relationship()
    {
        return $this->belongsTo(Relationship::class);
    }
}
