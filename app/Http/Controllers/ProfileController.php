<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\Profile;
use App\Followable;
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
        return response()->json(Profile::where('type',1)->get(), 200);
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
        $company->currency = $request->currency;
        $company->country = $request->country ?? 'PYG';
        $company->type = 2;
        $company->save();

        //Laravel Follow
        Auth::user()->profile->follow($company);

        //Stream follow
        $follower = Followable::where('profile_id', Auth::user()->profile_id)
        ->where('followable_id', $company->id)
        ->first();

        if (isset($follower))
        {
            $follower->role = 1;
            $follower->save();
        }

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
        $profile->taxid = $request->taxid;
        $profile->name = $request->name;
        $profile->alias = $request->alias;
        $profile->slug = $request->slug;

        $profile->short_description = $request->short_description;
        $profile->long_description = $request->long_description;

        $profile->telephone = $request->telephone;
        $profile->email = $request->email;
        $profile->website = $request->website;

        $profile->address = $request->address;
        $profile->zip = $request->zip;
        $profile->state = $request->state;
        $profile->country = $request->country ?? 'PYG';

        $profile->currency = $request->currency;
        $profile->save();

        return redirect()->back();
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

    public function followingUnfollowing($user, $profile)
    {
        $user = Profile::where('id',$user)->first();
        $profile = Profile::where('id',$profile)->first();

        if ($profile->isFollowedBy($user))
        { $user->unfollow($profile); }
        else
        { $user->follow($profile); }

        return response()->json('save', 200);
    }

    public function get_followers($user,$profile)
    {
        $user = Profile::where('id', $user)->first();
        $profile = Profile::where('id', $profile)->first();

        return response()->json($profile->isFollowedBy($user));
    }

    public function get_companies($id)
    {
        $user = User::where('profile_id', $id)->first();
        $companies = $user->profile->followings(\App\Profile::class)->where('role', '<', 4)->get();
        return response()->json($companies);
    }

    public function getProfile($frase)
    {
        $profiles = Profile::where('type', 1)
        ->where('slug', 'LIKE', "%$frase%")
        ->get();

        return response()->json($profiles);
    }
}
