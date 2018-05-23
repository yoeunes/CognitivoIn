<?php
namespace App;

use App\Scopes\RelationshipScope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Scout\Searchable;
use App\Profile;

class Relationship extends Model
{
  use Searchable;

  protected $table = 'relationships';
  //Filters records belonging to me.
  protected static function boot()
  {
    parent::boot();
    static::addGlobalScope(new RelationshipScope);
  }


  protected $fillable = [
    'id',
    'customer_id',
    'customer_alias',
    'customer_taxid',
  ];

  public function toSearchableArray()
  {
    return $this->only('customer_alias', 'customer_taxid', 'customer_geoloc', 'customer_address', 'customer_telephone', 'customer_email',
    'supplier_alias', 'supplier_taxid', 'supplier_geoloc', 'supplier_address', 'supplier_telephone', 'supplier_email');
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
