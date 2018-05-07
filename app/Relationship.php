<?php
namespace App;

use App\Scopes\RelationshipScope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Profile;

class Relationship extends Model
{
    protected static function boot()
    {
        parent::boot();

        //Filters records belonging to me.
        static::addGlobalScope(new RelationshipScope);
    }

    public function scopeGetCustomers($query)
    {
        return $query
        ->where('supplier_id', request()->route('profile')->id)
        //->where('customer_accepted', true) //No need for this as Global Scope handles this filter.
        ->with('customer');
    }

    public function scopeGetSuppliers($query)
    {
        return $query
        ->where('customer_id', request()->route('profile')->id)
        //->where('customer_accepted', true) //No need for this as Global Scope handles this filter.
        ->with('supplier');
    }

    public function scopeGetPendingInvitations($query)
    {
        return $query
        ->where('customer_accepted', '!=', 'supplier_accepted');
    }

    public function customer()
    {
        return $this->belongsTo(Profile::class, 'customer_id');
    }

    public function supplier()
    {
        return $this->belongsTo(Profile::class, 'supplier_id');
    }
}
