<?php

namespace App\Http\Controllers;

use App\Scheduals;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Profile;
use App\Relationship;
use App\AccountMovement;
use DB;

class SchedualController extends Controller
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
  public function store(Request $request)
  {
    //
  }

  /**
  * Display the specified resource.
  *
  * @param  \App\Scheduals  $scheduals
  * @return \Illuminate\Http\Response
  */
  public function show(Scheduals $scheduals)
  {
    //
  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  \App\Scheduals  $scheduals
  * @return \Illuminate\Http\Response
  */
  public function edit(Scheduals $scheduals)
  {
    //
  }

  /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  \App\Scheduals  $scheduals
  * @return \Illuminate\Http\Response
  */
  public function update(Request $request, Scheduals $scheduals)
  {
    //
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  \App\Scheduals  $scheduals
  * @return \Illuminate\Http\Response
  */
  public function destroy(Scheduals $scheduals)
  {
    //
  }
  public function GenreateSchedual(Request $request,Profile $profile)
  {

  }



  }
