<?php

namespace App;

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
        'pipeline_stage_id',
        'deadline_date',
        'description',
        'status',
        'value',
        'is_archived'
    ];

    public function scopeMine($query)
    {
        return $query->join('relationships', 'relationships.id', 'opportunities.relationship_id')
        ->where('relationships.supplier_id', request()->route('profile')->id);
    }

    public function pipelineStage()
    {
        return $this->belongsTo(PipelineStage::class);
    }

    public function relationship()
    {
        return $this->belongsTo(Relationship::class);
    }

    public function items()
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
