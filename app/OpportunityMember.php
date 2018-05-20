<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OpportunityMember extends Model
{
    use SoftDeletes;
    // use Searchable;

    protected $table = 'opportunity_members';

    /**
    * Fields that can be mass assigned.
    *
    * @var array
    */
    protected $fillable = [
        'opportunity_id',
        'profile_id',
        'role'
    ];

    public function opportunity()
    {
        return $this->belongsTo(Opportunity::class);
    }

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}
