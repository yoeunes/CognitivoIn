<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Scheduals extends Model
{
    use SoftDeletes;

    protected $table = 'scheduals';

    /**
    * Fields that can be mass assigned.
    *
    * @var array
    */
    protected $fillable = [
        'relationship_id',
        'currency_id',
        'rate',
        'debit',
        'credit',
        'date',
        'date_exp',
        'classification',
        'comment'
    ];
}
