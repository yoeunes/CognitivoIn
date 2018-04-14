<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BackOfficeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('back_office.index');
        // return view('home');
    }

    public function indexDashboard()
    {
        return view('back_office.dashboard');
    }

    public function indexProfile()
    {
        return view('back_office.profile');
    }
}
