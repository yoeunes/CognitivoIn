<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class AccountMovement extends Model
{
  use SoftDeletes;

  protected $table = 'account_movements';

  /**
  * Fields that can be mass assigned.
  *
  * @var array
  */
  protected $fillable = [
      'schedual_id',
      'account_id',
      'currency_id',
      'rate',
      'debit',
      'credit',
      'date',

  ];
}
