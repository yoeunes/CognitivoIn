<?php

namespace App\Http\Controllers;

use App\Followable;
use App\Profile;
use App\Http\Resources\FollowableResource;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use Swap\Laravel\Facades\Swap;

class FollowerController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(Profile $profile, $skip)
    {

  return FollowableResource::collection(Followable::with('profile')
  ->where('followable_id',$profile->id)->paginate(25));
        // $members = Followable::with('profile')
        // ->where('followable_id',$profile->id)
        // ->skip($skip)
        // ->take(100)
        // ->get();
        //
        //
        //
        // return response()->json($members);
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

        $followable = Followable::where('id', $request->id)->first() ?? new Followable();
        $followable->profile_id = $request->profile_id;
        $followable->followable_id =$profile->id ;
        $followable->followable_type ="App\Profile";
        $followable->relation ="follow";
        $followable->role =$request->role;
        $followable->save();
        if ($request->id > 0)
        {
            return response()->json('Updated', 200);
        }

        return response()->json($followable, 200);
    }

    /**
    * Display the specified resource.
    *
    * @param  \App\AccountMovement  $accountMovement
    * @return \Illuminate\Http\Response
    */
    public function show(Followable $followable)
    {
        //
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\AccountMovement  $accountMovement
    * @return \Illuminate\Http\Response
    */
    public function edit(Profile $profile,$followable)
    {

        $members = Followable::where('id', $followable)
        ->with('profile')
        ->first();

        return response()->json($members);
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\AccountMovement  $accountMovement
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, Followable $followable)
    {
        //
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\AccountMovement  $accountMovement
    * @return \Illuminate\Http\Response
    */
    public function destroy(Profile $profile, $followable )
    {
        $members = Followable::where('id', $followable)
        ->with('profile')
        ->first();
        if ($members->followable_id == $profile->id)
        {
            $members->delete();
            return response()->json('Done', 200);
        }



        return response()->json('Unkown Resource', 401);
    }


}
