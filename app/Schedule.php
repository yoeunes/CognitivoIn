<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Schedule extends Model
{
    use SoftDeletes;

    protected $table = 'schedule';
    protected $with = ['payments'];

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

    public function getBalance()
    {
        return ($this->credit - $this->debit) - ($this->payments->sum('credit' - 'debit') ?? 0);
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
