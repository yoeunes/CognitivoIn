<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NavigationController extends Controller
{
    public function index($url)
    {
        return view('back_office.index');
    }
}
