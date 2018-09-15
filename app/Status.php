<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Status extends Model
{

    protected $table = 'statuses';



    /**
    * Fields that can be mass assigned.
    *
    * @var array
    */
    protected $fillable = [
        'id',
        'name',
        'reason',
        'model_type',
        'model_id'
    ];
}
