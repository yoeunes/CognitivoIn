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
    public function index(Profile $profile)
    {
      $pipelinestages = PipelineStage::get();

      return response()->json($pipelinestages);
    }
    public function get_pipelinestages(Profile $profile)
    {


    }
    public function list_pipelinestages(Profile $profile,$skip)
    {

      $pipelinestages = PipelineStage::skip($skip)
        ->take(100)->get();

      return response()->json($pipelinestages);
    }
    public function list_pipelinestagesByID(Profile $profile,$id)
    {


      $pipelinestage = PipelineStage::where('id',$id)
        ->get();


      return response()->json($pipelinestage);
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
    public function store(Profile $profile,Request $request)
    {

        $pipelinestage = $request->stage_id == 0 ? new PipelineStage() :
        PipelineStage::where('id',$request->stage_id)->first();;

        $pipelinestage->pipeline_id = $request->id;

        $pipelinestage->name = $request->stage_name;

        $pipelinestage->completed = 1;

        $pipelinestage->sequence =  $request->stage_sequence == null ? 1 : $request->stage_sequence;

        $pipelinestage->save();

              return response()->json(PipelineStage::where('pipeline_id',$request->id)->get(),200);
    }

    /**
    * Display the specified resource.
    *
    * @param  \App\PipelineStage  $pipelineStage
    * @return \Illuminate\Http\Response
    */
    public function show(PipelineStage $pipelineStage)
    {
        //
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\PipelineStage  $pipelineStage
    * @return \Illuminate\Http\Response
    */
    public function edit(Profile $profile,PipelineStage $pipelinestage)
    {

    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\PipelineStage  $pipelineStage
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request,Profile $profile, PipelineStage $pipelineStage)
    {

    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\PipelineStage  $pipelineStage
    * @return \Illuminate\Http\Response
    */
    public function destroy(Profile $profile,PipelineStage $pipelinestage)
    {
        $pipeline = Pipeline::where('id',$pipelinestage->pipeline_id)->first();

        $pipelinestage->delete();
  return response()->json('200',200);
    }
}
