<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Overtrue\LaravelFollow\Traits\CanBeLiked;

class ProfilePost extends Model
{
    use CanBeLiked, \GetStream\StreamLaravel\Eloquent\ActivityTrait;

    /**
    * Get the profile that owns the model.
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }

    public function activityActorMethodName()
    {
        return 'profile';
    }
}
