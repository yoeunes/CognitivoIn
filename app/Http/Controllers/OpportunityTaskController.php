<?php

namespace App\Http\Controllers;
use App\Profile;
use App\Opportunity;
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
    public function store(Request $request, Profile $profile, Opportunity $opportunity)
    {
      
        if ($profile->id == $opportunity->profile_id)
        {
            $opportunityTask = OpportunityTask::find($request->id) ?? new OpportunityTask();
            $opportunityTask->activity_type = $request->activity_type ?? 1;
            $opportunityTask->opportunity_id = $opportunity->id;
            $opportunityTask->sentiment = $request->sentiment ?? 0;
            $opportunityTask->reminder_date = $request->reminder_date ?? null;
            $opportunityTask->date_started = $request->date_started ?? Carbon::now();
            $opportunityTask->date_ended = $request->date_ended ?? null;
            $opportunityTask->title = $request->title ?? 'Title Missing';
            $opportunityTask->description = $request->description ?? null;
            $opportunityTask->geoloc = $request->geoloc ?? null;
            $opportunityTask->completed = $request->completed ?? 0;
            $opportunityTask->save();

            return response()->json($opportunityTask, 200);
        }

        return response()->json('Resource not found', 401);
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\OpportunityTask  $opportunityTask
    * @return \Illuminate\Http\Response
    */
    public function edit(Profile $profile, Opportunity $opportunity, OpportunityTask $opportunityTask)
    {
        if ($profile->id == $opportunity->profile_id)
        {
            return response()->json($opportunityTask);
        }

        return response()->json('Resource not found', 401);
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
