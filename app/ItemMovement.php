<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemMovement extends Model
{
  protected $table = 'item_movements';

    /**
    * Fields that can be mass assigned.
    *
    * @var array
    */
    protected $fillable = [
        'item_id',
        'location_id',
        'date',
        'debit',
        'credit',
        'comment'
    ];
    public function item()
    {
      return $this->belongsTo(Item::class);
    }
    public function location()
    {
      return $this->belongsTo(Location::class);
    }
}
