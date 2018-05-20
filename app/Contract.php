<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    //use SoftDeletes;
    protected $table = 'contracts';

    /**
    * Fields that can be mass assigned.
    *
    * @var array
    */
    protected $fillable = [
        'name',
        'profile_id',
        'country'
    ];

    public function details()
    {
        return $this->hasMany(ContractDetail::class);
    }
}
