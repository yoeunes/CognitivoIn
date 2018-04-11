<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TargetMarket extends Model
{
    //
    public function targetable()
    {
        return $this->morphTo();
    }
}
