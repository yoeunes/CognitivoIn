<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Location extends Model
{
    protected $table = 'locations';

    /**
    * Fields that can be mass assigned.
    *
    * @var array
    */
    protected $fillable = [
        'name',
        'telephone',
        'address',
        'state',
        'profile_id',

        'country'
    ];

}
