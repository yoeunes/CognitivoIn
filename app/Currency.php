<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    /**
    * The database table used by the model.
    *
    * @var string
    */
    protected $table = 'currencies';

    /**
    * Query scope getCurrencies.
    *
    * @param  \Illuminate\Database\Eloquent\Builder
    * @return \Illuminate\Database\Eloquent\Builder
    */
    public function scopeGetCurrencies($query)
    {
        return $query->get();
    }


        /**
        * Query scope getCurrencies.
        *
        * @param  \Illuminate\Database\Eloquent\Builder
        * @return \Illuminate\Database\Eloquent\Builder
        */
        public function scopeSearchCurrencies($query,$id)
        {
          
            return $query->where('id',$id);
        }
}
