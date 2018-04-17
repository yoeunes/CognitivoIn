<?php

namespace App\Http\Controllers\Api;

use App\Item;
use App\Relationship;
use App\Profile;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function list_items(Profile $profile,$location)
    {
        if (isset($location)) {
            $items =Item::GetItems($profile->id)
            ->get();
        }
        else {
            $items =Item::GetItems($profile->id)
            ->where('name', 'LIKE', "%$frase%")

            ->get();
        }

    return response()->json($items);
    }







}
