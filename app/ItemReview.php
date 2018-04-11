<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Overtrue\LaravelFollow\Traits\CanBeLiked;

class ItemReview extends Model
{
    use CanBeLiked;

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}
