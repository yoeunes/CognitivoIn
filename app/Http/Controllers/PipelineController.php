<?php

namespace App\Http\Controllers;

use App\Profile;
use App\Pipeline;
use App\PipelineStage;
use App\Http\Resources\PipelineResource;
use Illuminate\Http\Request;

class PipelineController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(Profile $profile)
    {
        return PipelineResource::collection(Pipeline::My($profile)
        ->with('stages')->paginate(25));
        // $pipelines = Pipeline::My($profile)
        // ->with('stages')
        // ->skip($skip)
        // ->take(100)
        // ->get();
        //
        // return response()->json($pipelines);
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
    public function store(Profile $profile, Request $request)
    {
        $pipeline = Pipeline::where('id', $request->id)->first() ?? new Pipeline();

        $pipeline->profile_id = $profile->id;
        $pipeline->name = $request->name;
        $pipeline->is_active = true;
        $pipeline->save();

        $stages = collect($request->stages);

        foreach ($stages as $stage)
        {
            if ($stage['stage_name']!=null)
            {
                $pipelineStage = $stage['id'] > 0 ? PipelineStage::where('id', $stage['id'])->first() : new PipelineStage();
                $pipelineStage->pipeline_id = $pipeline->id;
                $pipelineStage->name = $stage['stage_name'];
                $pipelineStage->completed = $stage['stage_completed'] ?? 1;
                $pipelineStage->sequence =  $stage['stage_sequence'] ?? 1;

                $pipelineStage->save();
            }


        }

        return response()->json('Done', 200);
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
        $pipeline = Pipeline::where('id', $pipeline->id)
        ->with('stages')
        ->first();

        return response()->json($pipeline);
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
        if ($pipeline->profile_id == $profile->id)
        {
            $pipeline->delete();
            return response()->json('200', 200);
        }

        return response()->json('Resource not found', 401);
    }
}
