<?php

namespace App;

use App\Scopes\ProfileScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Overtrue\LaravelFollow\Traits\CanBeFollowed;
use Overtrue\LaravelFollow\Traits\CanBeFavorited;

class Opportunity extends Model
{
    use SoftDeletes, CanBeFollowed, CanBeFavorited;
    // use Searchable;

    protected $table = 'opportunities';

    protected $fillable = [
        'relationship_id',
        'pipeline_id',
        'deadline_date',
        'description',
        'status',
        'value',
        'is_archived'
    ];


    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new ProfileScope);
    }

    public function pipeline()
    {
        return $this->belongsTo(Pipeline::class);
    }

    public function relationship()
    {
        return $this->belongsTo(Relationship::class);
    }

    public function items()
    {
        return $this->belongsToMany(Item::class, 'carts');
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function tasks()
    {
        return $this->hasMany(OpportunityTask::class);
    }

    public function members()
    {
        return $this->belongsToMany(Profile::class, 'opportunity_members');
    }
}
