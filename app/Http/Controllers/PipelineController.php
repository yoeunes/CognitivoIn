<?php

namespace App\Http\Controllers;

use App\Profile;
use App\Pipeline;
use App\PipelineStage;
use Illuminate\Http\Request;

class PipelineController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(Profile $profile,$skip)
    {
        $pipelines = Pipeline::with('stages')->Pipelines($profile->id)->skip($skip)
        ->take(100)->get();

        return response()->json($pipelines);
    }


    public function list_pipelinesByID(Profile $profile,$id)
    {


        $pipelines = Pipeline::with('stages')->Pipelines($profile->id)

        ->where('id',$id)

        ->get();


        return response()->json($pipelines);
    }
    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create(Profile $profile)
    {
        return view('company.sales.opportunities.pipeline.form');
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Profile $profile,Request $request)
    {

        $pipeline =$request->id == 0 ? new Pipeline() :
        Pipeline::where('id',$request->id)->first();

        $pipeline->profile_id = $profile->id;
        $pipeline->name = $request->name;
        $pipeline->is_active = true;

        $pipeline->save();

        return response()->json('ok',200);

    }

    /**
    * Display the specified resource.
    *
    * @param  \App\Pipeline  $pipeline
    * @return \Illuminate\Http\Response
    */
    public function show(Profile $profile, Pipeline $pipeline)
    {
        //
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Pipeline  $pipeline
    * @return \Illuminate\Http\Response
    */
    public function edit(Profile $profile, Pipeline $pipeline)
    {
        return response()->json($pipeline->with('stages')->first());
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Pipeline  $pipeline
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, Profile $profile, Pipeline $pipeline)
    {

    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Pipeline  $pipeline
    * @return \Illuminate\Http\Response
    */
    public function destroy(Profile $profile, Pipeline $pipeline)
    {
        $pipeline->delete();

        return response()->json('200',200);
    }
}
