<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VatDetail extends Model
{
  //use SoftDeletes;
  protected $table = 'vat_details';

  /**
  * Fields that can be mass assigned.
  *
  * @var array
  */
  protected $fillable = [
    'id',
      'vat_id',
      'coefficient',
      'percent'
  ];



  public function vat()
  {
      return $this->belongsTo('App\Vat','id','vat_id');
  }
}
