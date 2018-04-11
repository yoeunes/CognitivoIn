<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PipelineStage extends Model
{
    use SoftDeletes;
    protected $table = 'pipeline_stages';

    /**
    * Fields that can be mass assigned.
    *
    * @var array
    */
    protected $fillable = [
        'pipeline_id',
        'sequence',
        'name'
    ];

    public function scopeMyStages($query,$id)
    {
        return $query
        ->join('pipelines', 'pipelines.id', 'pipeline_stages.pipeline_id')
        ->where('pipelines.profile_id', $id);
    }

    public function pipeline()
    {
        return $this->belongsTo('App\Pipeline');
    }
}
