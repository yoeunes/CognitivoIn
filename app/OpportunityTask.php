<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OpportunityTask extends Model
{
    use SoftDeletes; //, \GetStream\StreamLaravel\Eloquent\ActivityTrait;
    // use Searchable;

    protected $table = 'opportunity_tasks';

    /**
    * Fields that can be mass assigned.
    *
    * @var array
    */
    protected $fillable = [
        'activity_type_id',
        'opportunity_id',
        'date_reminder',
        'date_startes',
        'date_ended'
    ];

    public function opportunity()
    {
        return $this->belongsTo(Opportunity::class);
    }

    public function activityActorMethodName()
    {
        return 'team';
    }
}
