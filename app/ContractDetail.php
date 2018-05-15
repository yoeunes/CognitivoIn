<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContractDetail extends Model
{
  //use SoftDeletes;
  protected $table = 'contract_details';

  /**
  * Fields that can be mass assigned.
  *
  * @var array
  */
  protected $fillable = [
      'contract_id',
      'offset',
      'percent'
  ];



  public function vat()
  {
      return $this->belongsTo('App\Contract');
  }
}
