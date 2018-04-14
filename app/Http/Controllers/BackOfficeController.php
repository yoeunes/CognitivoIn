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
        return view('back_office.dashboard');
        // return view('home');
    }

    public function showDashboard()
    {
        return view('back_office.dashboard');
    }
}
