<?php

namespace App\Http\Controllers;

use App\Profile;
use App\Opportunity;
use App\OpportunityMember;
use App\OpportunityTask;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class OpportunityTaskController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index(Profile $profile, Opportunity $opportunity)
  {
    $opportunityTasks = OpportunityTask::where('opportunity_id', $opportunity->id)
    ->get();

    return response()->json($opportunityTasks);
  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function store(Request $request, Profile $profile, $opportunity)
  {
    $opportunity=Opportunity::find($opportunity);
    if ($profile->id == $opportunity->profile_id && $request->title != '')
    {
      $opportunityTask = OpportunityTask::find($request->id) ?? new OpportunityTask();
      $opportunityTask->activity_type = $request->activity_type ?? 1;
      $opportunityTask->opportunity_id = $opportunity->id;
      $opportunityTask->sentiment = $request->sentiment ?? 0;
      $opportunityTask->date_reminder = $request->date_reminder != null ? Carbon::parse($request->date_reminder) : null;
      $opportunityTask->date_started = $request->date_started != null ? Carbon::parse($request->date_started) : Carbon::now();
      $opportunityTask->date_ended = $request->date_ended != null ? Carbon::parse($request->date_ended) : null;
      $opportunityTask->title = $request->title;
      $opportunityTask->description = $request->description ?? null;
      $opportunityTask->geoloc = $request->geoloc ?? null;
      $opportunityTask->completed = $request->completed ?? 0;
      $opportunityTask->assigned_to = $request->assigned_to ?? null;
      $opportunityTask->created_by = ($request->id > 0 ? $opportunityTask->created_by : $request->profile_id) ?? null;
      //$opportunityTask->created_by = Auth::user()->profile_id;
      $opportunityTask->save();

      return response()->json($opportunityTask, 200);
    }

    return response()->json('Resource not found', 401);
  }

  public function taskChecked(Request $request, Profile $profile, Opportunity $opportunity)
  {
    $opportunityTask = OpportunityTask::find($request->id);

    if ($opportunityTask)
    {
      $opportunityTask->completed = $request->completed == true ? false : true;
      $opportunityTask->completed_at = $request->completed == true ? Carbon::now() : null;
      $opportunityTask->completed_by = $request->completed == true ?$request->profile_id : null;

      //Set Sentiment to 0 each time the checked status changes.
      $opportunityTask->sentiment = $request->sentiment ?? 0;
      $opportunityTask->save();

      return response()->json('Ok', 200);
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
  public function destroy(Profile $profile, Opportunity $opportunity, $opportunityTaskID)
  {
    $opportunityTask = OpportunityTask::where('id', $opportunityTaskID)->first();
    //No need for soft delete.
    $opportunityTask->forceDelete();
    return response()->json('Ok', 200);
  }
}
