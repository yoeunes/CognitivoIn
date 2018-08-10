<?php

namespace App;

use Spatie\ModelStatus\HasStatuses;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
  use HasStatuses;
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

  public function order()
  {
    return $this->belongsTo(Order::class);
  }
}
