<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use App\Branch;
use App\Item;
use App\ProfilePost;
use App\ProfileReview;
use App\ProfileTag;
use App\ProfileTeam;
use Illuminate\Support\Facades\Auth;

use Cviebrock\EloquentSluggable\Sluggable;
use Laravel\Scout\Searchable;

use Overtrue\LaravelFollow\Traits\CanFollow;
use Overtrue\LaravelFollow\Traits\CanBeFollowed;

use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\HasMedia;

class Profile extends Model implements HasMedia
{
    use CanFollow, CanBeFollowed, Notifiable, Searchable, Sluggable, SoftDeletes;
    use HasMediaTrait;

    /**
    * The database table used by the model.
    *
    * @var string
    */
    protected $table = 'profiles';

    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
    * Fields that can be mass assigned.
    *
    * @var array
    */
    public $fillable = [
        'name',
        'slug',
        'type',
        'poster_img',
        'profile_img',
        'alias',
        'taxid',
        'geoloc',
        'address',
        'telephone',
        'email',
        'website',
        'short_description',
        'long_description',
        'avatar'
    ];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'alias'
            ]
        ];
    }

    public function searchableAs()
    {
        return 'profiles';
    }

    public function toSearchableArray()
    {
        return array_only($this->toArray(), ['id', 'name', 'slug', 'alias', 'taxid', 'address', 'telephone', 'email', 'website', 'short_description', 'long_description']);
    }

    /**
    * Profile belongs to Many Currencies.
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
    */
    //note: the first letter of first world if always in lower case
    public function currencies()
    {
        return $this->belongsToMany(Currency::class, 'currency_relationships', 'profile_id', 'currency_id')->withPivot('is_favorite');
    }

    public function targets()
    {
        return $this->morphToMany('App\Profile', 'targetable');
    }

    /**
    * Query scope getProfile.
    *
    * @param  \Illuminate\Database\Eloquent\Builder
    * @return \Illuminate\Database\Eloquent\Builder
    */
    public function scopeGetProfiles($query)
    {
        return $query
        // ->join('followables', 'followables.followable_id', '=', 'profiles.id')
        // ->where('followables.role', "!=", "'Follower'")
        // ->where('followables.user_id', '=', Auth::user()->profile_id)
        ->select('profiles.name', 'profiles.id', 'profiles.slug');
    }

    /**
    * Get the User record associated with the model.
    */
    public function user()
    {
        return $this->hasOne(User::class);
    }

    /**
    * Get the Branch for the model.
    */
    public function branches()
    {
        return $this->hasMany(Branch::class);
    }

    /**
    * Get the Tags for the model.
    */
    public function tags()
    {
        return $this->hasMany(ProfileTag::class);
    }

    /**
    * Get the Posts for the model.
    */
    public function posts()
    {
        return $this->hasMany(ProfilePost::class);
    }

    /**
    * Get the Review for the model.
    */
    public function reviews()
    {
        return $this->hasMany(ProfileReview::class);
    }

    /**
    * Get the Team for the model.
    */
    public function teams()
    {
        return $this->hasMany(ProfileTeam::class);
    }

    public function items()
    {
        return $this->hasMany(Item::class);
    }

    // public function registerMediaConversions(Media $media = null)
    // {
    //     $this->addMediaConversion('thumb')
    //     ->width(500)
    //     ->height(500)
    //     ->performOnCollections('images', 'downloads');
    // }
}
