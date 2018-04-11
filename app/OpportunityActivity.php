<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OpportunityActivity extends Model
{
    use SoftDeletes, \GetStream\StreamLaravel\Eloquent\ActivityTrait;
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
        'reminder_date',
        'date_startes',
        'date_ended'
    ];

    public function opportunity()
    {
        return $this->belongsTo('App\Opportunity');
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function activityActorMethodName()
    {
        return 'team';
    }
}
