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
}
