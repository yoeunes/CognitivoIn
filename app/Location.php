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
        'profile_id',
        'name',
        'telephone',
        'address',
        'zip',
        'city',
        'state',
        'country'
    ];

    /**
    * The accountMovements that belong to the model.
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
    */
    public function accountMovements()
    {
        return $this->belongsToMany(AccountMovement::class);
    }

    public function hours()
    {
        return $this->hasMany(LocationHour::class);
    }
}
