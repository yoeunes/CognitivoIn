<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Overtrue\LaravelFollow\Traits\CanBeFollowed;
use Overtrue\LaravelFollow\Traits\CanBeFavorited;

class Team extends Model
{
    //Teams can Be Followed and Favorited, but cannot follow or like.
    use CanBeFollowed, CanBeFavorited;

    protected $table = 'teams';

    /**
    * Fields that can be mass assigned.
    *
    * @var array
    */
    protected $fillable = [
        'name',
        'alias',
        'short_description',
        'long_description',
        'profile_id',

        'is_active'
    ];

}
