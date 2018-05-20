<?php

namespace App\Http\Controllers;

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
        $opportunityMember = OpportunityMember::find($request->id) ?? new OpportunityMember();
        $opportunityMember->activity_type = $request->activity_type ?? 1;
        $opportunityMember->opportunity_id = $request->opportunity_id;
        $opportunityMember->sentiment = $request->sentiment ?? 0;
        $opportunityMember->reminder_date = $request->reminder_date ?? null;
        $opportunityMember->date_started = $request->date_started ?? Carbon::now();
        $opportunityMember->date_ended = $request->date_ended ?? null;
        $opportunityMember->title = $request->title ?? 'Title Missing';
        $opportunityMember->description = $request->description ?? null;
        $opportunityMember->geoloc = $request->geoloc ?? null;
        $opportunityMember->completed = $request->completed ?? 0;
        $opportunityMember->save();

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
