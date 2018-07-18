<?php

namespace App\Http\Controllers\Api;

use App\Location;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AccountMovementController;
use Illuminate\Http\Request;
use DB;
use Swap\Laravel\Facades\Swap;

class LocationController extends Controller
{

  public function Upload(Request $request,Profile $profile)
  {
    $data = collect();

    if ($request->all() != [])
    {
      $data = collect($request->all());
    }

    $collection = json_decode($data->toJson());

    foreach ($collection as $key => $data)
    {
      $location = Location::where('id', $data->id)->first() ?? new Location();
      // $location = new Location();
      $location->profile_id = $profile->id;

      $location->name = $data->name;
      $location->telephone = $data->telephone ?? $profile->telephone;
      $location->address = $data->address ?? $profile->address;
      $location->city = $data->city;
      $location->state = $data->state ?? $profile->state;
      $location->country = $data->country ?? $profile->country;
      $location->zip = $data->zip;

      $location->save();
    }
  }

  public function Download(Request $request,Profile $profile)
  {
    $locations =Location::where('profile_id',$profile->id)
    ->get();
    return response()->json($locations);
  }


}
