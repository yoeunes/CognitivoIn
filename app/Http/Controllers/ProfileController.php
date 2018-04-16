<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\Profile;
use App\followables;
use \Overtrue\LaravelFollow\Traits\CanFollow;

class ProfileController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        //
    }

    /**
    * Show the form for creating a new Company Profile.
    * User profiles are created automatically from User Registration, thus no code is needed for that.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {

        return view('company.form'); //->with('countries', $countries);
    }

    /**
    * Store a newly created Company / Brand in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {

        //Create Company code. User Profile gets created automatically from User Registration.
        //Assign type = 2 for Company
        $company = new Profile();
        $company->name = $request->name;
        $company->alias = $request->alias;
        $company->address = $request->address;
        $company->taxid = $request->taxID;
        $company->type = 2;

        $company->save();

        //Laravel Follow
        //Auth::user()->profile->follow($company);

        //Stream follow

        // $follower= followables::where('user',Auth::user()->profile_id)->
        // where('followable_id',$company->id)->first();
        //
        // if (isset($follower)) {
        //     $follower->role=1;
        //     $follower->save();
        // }

        // $social = new ProfileFollower();
        // $social->profile_id = $profile->id;
        // $social->followable_id = Auth::user()->profile_id;
        // $social->role = 1;
        // $social->save();

        return view('/home');
    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show(Profile $profile)
    {

        return view('social.web')->with('profile', $profile);
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit(Profile $profile)
    {
        //
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, Profile $profile)
    {

    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy(Profile $profile)
    {
        //
    }

    public function followingUnfollowing($user,$profile)
    {
        $user=Profile::where('id',$user)->first();
        $profile=Profile::where('id',$profile)->first();
        if ($profile->isFollowedBy($user)) {
            $user->unfollow($profile);
        }
        else {
            $user->follow($profile);
        }
        return response()->json('save', 200);


    }


    public function get_followers($user,$profile)
    {
        $user=Profile::where('id',$user)->first();
        $profile=Profile::where('id',$profile)->first();

        return response()->json($profile->isFollowedBy($user));

    }



}
