<?php

namespace App;

use App\Scopes\ProfileScope;
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

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new ProfileScope);
    }

    public function details()
    {
        return $this->hasMany(ContractDetail::class);
    }
}
