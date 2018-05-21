<?php

namespace App\Http\Controllers;
use App\Profile;
use App\OpportunityMember;
use App\OpportunityTask;
use Illuminate\Http\Request;
use Carbon\Carbon;

class OpportunityTaskController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(Profile $profile, $skip, $opportuntiyID)
    {
        $opportunityTasks = OpportunityTask::where('opportunity_id', $opportuntiyID)
        ->get();

        return response()->json($opportunityTasks);
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
            
        $OpportunityTask = OpportunityTask::find($request->id) ?? new OpportunityTask();
        $OpportunityTask->activity_type = $request->activity_type ?? 1;
        $OpportunityTask->opportunity_id = $request->opportunity_id;
        $OpportunityTask->sentiment = $request->sentiment ?? 0;
        $OpportunityTask->reminder_date = $request->reminder_date ?? null;
        $OpportunityTask->date_started = $request->date_started ?? Carbon::now();
        $OpportunityTask->date_ended = $request->date_ended ?? null;
        $OpportunityTask->title = $request->title ?? 'Title Missing';
        $OpportunityTask->description = $request->description ?? null;
        $OpportunityTask->geoloc = $request->geoloc ?? null;
        $OpportunityTask->completed = $request->completed ?? 0;
        $OpportunityTask->save();

        return response()->json('Ok', 200);
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\OpportunityTask  $opportunityTask
    * @return \Illuminate\Http\Response
    */
    public function edit(OpportunityTask $opportunityTask)
    {
        return response()->json($opportunityTask);
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\OpportunityTask  $opportunityTask
    * @return \Illuminate\Http\Response
    */
    public function destroy(OpportunityTask $opportunityTask)
    {
        if ($contract->profile_id == $profile->id)
        {
            //No need for soft delete.
            $contract->forceDelete();
            return response()->json('200', 200);
        }

        return response()->json('Resource not found', 401);
    }
}
