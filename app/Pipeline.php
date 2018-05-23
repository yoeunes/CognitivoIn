<?php

namespace App;

use App\Scopes\ProfileScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pipeline extends Model
{
    use SoftDeletes;
    protected $table = 'pipelines';

    /**
    * Fields that can be mass assigned.
    *
    * @var array
    */
    protected $fillable = [
        'name',
        'is_active'
    ];

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new ProfileScope);
    }

    public function scopeMy($query, Profile $profile)
    {
        return $query->where('profile_id', $profile->id);
    }

    public function stages()
    {
        return $this->hasMany('App\PipelineStage');
    }

}
