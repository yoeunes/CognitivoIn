<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Schedule extends Model
{
    use SoftDeletes;

    protected $table = 'schedules';
    protected $with = ['payments'];

    protected $appends = array('balance');

    /**
    * Fields that can be mass assigned.
    *
    * @var array
    */
    protected $fillable = [
        'relationship_id',
        'order_id',
        'currency',
        'rate',
        'debit',
        'credit',
        'date',
        'due_date',
        'classification',
        'comment'
    ];

    public function getBalanceAttribute()
    {
        return $this->value - ($this->payments->sum('credit') ?? 0);
    }

    public function scopeReceivables($query)
    {
        //TODO figure out how to use this profile -> to filter out relationships without calling the relationship.
        $profile = request()->route('profile');

        return $query->where('balance', '>', 0);
    }

    public function scopePayables($query)
    {
        //TODO figure out how to use this profile -> to filter out relationships without calling the relationship.
        $profile = request()->route('profile');

        return $query->where('balance', '>', 0);
    }

    /**
    * Get the payments for the model.
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
    public function payments()
    {
        return $this->hasMany(AccountMovement::class);
    }

    /**
    * Get the relationship that owns the model.
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function relationship()
    {
        return $this->belongsTo(Relationship::class);
    }
}
