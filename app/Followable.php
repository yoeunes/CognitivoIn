<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Followable extends Model
{
  protected $table = 'followables';

  /**
  * Fields that can be mass assigned.
  *
  * @var array
  */
  protected $fillable = [
      'profile_id',
      'followable_id',
      'followable_type',
      'relation',
      'role'

  ];
  public function profile()
  {
      return $this->belongsTo(Profile::class);
  }

}
