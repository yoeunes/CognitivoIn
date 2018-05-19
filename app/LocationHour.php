<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LocationHour extends Model
{
    protected $table = 'location_hours';

    /**
    * Fields that can be mass assigned.
    *
    * @var array
    */
    protected $fillable = [
        'location_id',
        'day',
        'open_time',
        'close_time',
        'open_holidays'
    ];

    public function location()
    {
        return $this->hasOne(Location::class);
    }
}
