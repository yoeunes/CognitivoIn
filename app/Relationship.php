<?php
namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Profile;

class Relationship extends Model
{

    public function scopeGetCustomers($query)
    {
        return $query
        ->where('supplier_id', request()->route('profile')->id)
        ->where('supplier_accepted', true)
        ->with('customer');
    }

    public function scopeGetSuppliers($query)
    {
        return $query
        ->where('customer_id', request()->route('profile')->id)
        ->where('customer_accepted', true)
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
