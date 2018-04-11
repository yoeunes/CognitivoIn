<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Session;

class ProfileFollower extends Model
{
    use Notifiable;

    protected $table = 'profile_followers';
    public $primaryKey = 'id';

    /**
     * Get the follower that owns the model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function follower()
    {
        return $this->belongsTo(Profile::class, 'id', 'profile_id');
    }

    public function following()
    {
        return $this->belongsTo(Profile::class, 'id', 'followable_id');
    }
}
