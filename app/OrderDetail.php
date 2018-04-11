<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = 'order_details';
    protected $fillable = [
    'order_id',
    'quantity',
    'unit_price',
    'comment'
  ];

  public function item()
  {
    return $this->belongsTo(Item::class);
  }
}
