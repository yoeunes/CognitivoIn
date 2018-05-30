<?php

namespace App;

use App\Scopes\ProfileScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vat extends Model
{
    //use SoftDeletes;
    protected $table = 'vats';

    /**
    * Fields that can be mass assigned.
    *
    * @var array
    */
    protected $fillable = [
        'name',
        'country',
        'applied_on'
    ];

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new ProfileScope);
    }

    public function details()
    {
        return $this->hasMany('App\VatDetail');
    }
}
