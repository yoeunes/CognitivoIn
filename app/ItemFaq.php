<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Profile;


class ItemFaq extends Model
{
    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }

    public function responses()
    {
        return $this->hasMany(ItemFaq::class, 'item_faq_id');
    }
}
