<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class RelationshipScope implements Scope
{
    /**
     * Show only relationships where Customer or Supplier has been accepted and is equal to currently selected profile.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        $profile = request()->route('profile');
        if (isset($profile))
        {
            $builder
            ->where(function($q) use($profile)
            {
                $q->where('customer_id', $profile->id)
                ->where('customer_accepted', 1);
            })
            ->orWhere(function($q) use($profile)
            {
                $q->where('supplier_id', $profile->id)
                ->where('supplier_accepted', 1);
            });
        }
    }
}
