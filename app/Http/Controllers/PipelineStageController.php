<?php

namespace App\Http\Controllers;

use App\Profile;
use App\Pipeline;
use App\PipelineStage;
use Illuminate\Http\Request;

class PipelineStageController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(Profile $profile, $skip)
    {

    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create(Profile $profile)
    {

    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Profile $profile, Request $request)
    {


        return response()->json('Done', 200);
    }

    /**
    * Display the specified resource.
    *
    * @param  \App\Pipeline  $pipelineStage
    * @return \Illuminate\Http\Response
    */
    public function show(Profile $profile, PipelineStage $pipelineStage)
    {
        //
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\PipelineStage  $pipelineStage
    * @return \Illuminate\Http\Response
    */
    public function edit(Profile $profile, PipelineStage $pipelineStage)
    {
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\PipelineStage  $pipelineStage
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, Profile $profile, PipelineStage $pipelineStage)
    {

    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\PipelineStage  $pipelineStage
    * @return \Illuminate\Http\Response
    */
    public function destroy(Profile $profile, $pipelineStage)
    {
        $pipelineStage=PipelineStage::find($pipelineStage);

        $pipelineStage->delete();
        return response()->json('200', 200);


    
    }
}
