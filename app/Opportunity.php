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
        'stage_id',
        'deadline_date',
        'description',
        'status',
        'value'
    ];

    public function scopeMine($query)
    {
        return $query->join('relationships', 'relationships.id', 'opportunities.relationship_id')
            ->where('relationships.supplier_id', request()->route('profile')->id);
    }

    public function stage()
    {
        return $this->belongsTo('App\PipelineStage');
    }

    public function relationship()
    {
        return $this->belongsTo('App\Relationship');
    }
}
