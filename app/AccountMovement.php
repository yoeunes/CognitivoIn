<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Account;;
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
      'currency',
      'rate',
      'debit',
      'credit',
      'date',

  ];

  public function account()
  {
      return $this->belongsTo(Account::class);
  }
}
