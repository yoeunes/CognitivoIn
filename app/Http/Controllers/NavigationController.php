<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profile;

class NavigationController extends Controller
{
    public function index(Profile $profile,$url)
    {
     
        return view('back_office.index');
    }
}
