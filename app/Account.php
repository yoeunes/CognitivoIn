<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Account extends Model
{
  use SoftDeletes;

  protected $table = 'accounts';

  /**
  * Fields that can be mass assigned.
  *
  * @var array
  */
  protected $fillable = [
      'bank_relationship_id',
      'currency',
      'name',
      'number',
      'is_active'


  ];
}
