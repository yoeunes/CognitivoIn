<?php

namespace App\Http\Controllers;

use App\Location;
use App\Profile;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(Profile $profile, $skip)
    {
        $location = Location::skip($skip)
        ->take(100)
        ->get();

        return response()->json($location);
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        //
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Profile $profile, Request $request)
    {
        $location = Location::where('id', $request->id)->first() ?? new Location();
        // $location = new Location();
        $location->profile_id = $profile->id;

        $location->name = $request->name;
        $location->telephone = $request->telephone ?? $profile->telephone;
        $location->address = $request->address ?? $profile->address;
        $location->city = $request->city;
        $location->state = $request->state ?? $profile->state;
        $location->country = $request->country ?? $profile->country;
        $location->zip = $request->zip;

        $location->save();

        if ($request->id > 0)
        {
            return response()->json('Updated', 200);
        }

        return response()->json($location, 200);
    }

    /**
    * Display the specified resource.
    *
    * @param  \App\Location  $location
    * @return \Illuminate\Http\Response
    */
    public function show(Location $location)
    {
        //
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Location  $location
    * @return \Illuminate\Http\Response
    */
    public function edit(Profile $profile, Location $location)
    {
        $location = Location::where('id', $location->id)
        ->with('hours')
        ->first();

        return response()->json($location);
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Location  $location
    * @return \Illuminate\Http\Response
    */
    public function destroy(Profile $profile, Location $location)
    {
        if ($location->profile_id == $profile->id)
        {
            $location->delete();
            return response()->json('Done', 200);
        }

        return response()->json('Resource not found', 401);
    }
}
