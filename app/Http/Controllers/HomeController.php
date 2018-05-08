<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profile;
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
        if ($profile != null)
        {
            return view('back_office.index');
        }
        else
        {
            return view('home');
        }
    }
}
