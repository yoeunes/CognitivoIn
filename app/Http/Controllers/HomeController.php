<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profile;
use Auth;

class HomeController extends Controller
{
    /**
    * Create a new controller instance.
    *
    * @return void
    */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
    * Show the application dashboard.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(Profile $profile = null)
    {
        //Check if profile is in url.
        if ($profile != null)
        {
            //check if user has ownership of profile to open backend.
            $isOwner = Auth::user()->profile->followings(Profile::class)
            ->where('followable_id', $profile->id)
            ->where('role', '<', 4)
            ->exists() ?? false;

            if ($isOwner)
            {
                return view('back_office.index');
            }

            //if not ownership, then show social page. as if it were any other user. Also the page must not be private.
            if ($profile->is_private == false)
            {
                return view('social.web')->with('profile', $profile);
            }

        }

        //if no profile in url, just show home screen.
        return view('home');
    }
}
