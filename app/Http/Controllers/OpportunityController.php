<?php

namespace App\Http\Controllers;

use App\Opportunity;
use App\OpportunityTask;
use App\OpportunityMember;
use App\Profile;
use App\Cart;
use App\PipelineStage;
use App\Pipeline;
use App\Relationship;
use Illuminate\Http\Request;

class OpportunityController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(Profile $profile, $skip, $filterBy)
    {
        $opportunities = Opportunity::Mine()
        ->skip($skip)
        ->take(100)
        ->get();

        return response()->json($opportunities);
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request, Profile $profile)
    {
        $opportunity = Opportunity::where('id', $request->id)->first() ?? new Opportunity();

        $opportunity->relationship_id = $request->relationship_id;
        $opportunity->pipeline_stage_id = $request->pipeline_stage_id;
        $opportunity->deadline_date = $request->deadline_date;
        $opportunity->description = $request->description;
        $opportunity->status = 1;
        $opportunity->value = $request->value;
        $opportunity->is_archived = $request->is_archived;
        $opportunity->save();

        $members = collect($request->members);

        //if opportunity is new, then create user as it's first member.
        if ($request->id == 0)
        {
            $member = new OpportunityMember();
            $member->opportunity_id = $opportunity->id;
            $member->profile_id = Auth::user()->profile_id;
            $member->save();
        }

        //do not iterate over tasks and members. they will have their own individual functions
        return response()->json('Ok', 200);
    }

    /**
    * Display the specified resource.
    *
    * @param  \App\opportunity  $opportunity
    * @return \Illuminate\Http\Response
    */
    public function show(Profile $profile, Opportunity $opportunity)
    {
        $opportunity = $opportunity
        ->with('activities')
        ->with('members')
        ->first();

        return response()->json($opportunity);
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\opportunity  $opportunity
    * @return \Illuminate\Http\Response
    */
    public function edit(Profile $profile, Opportunity $opportunity)
    {
        return response()->json($opportunity);
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\opportunity  $opportunity
    * @return \Illuminate\Http\Response
    */
    public function destroy(Opportunity $opportunity)
    {
        $relationship = $opportunity->relationship();
        if ($relationship->supplier_id == $profile->id)
        {
            //No need for soft delete.
            $opportunity->delete();
            return response()->json('Ok', 200);
        }

        return response()->json('Resource not found', 401);
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Contract  $contract
    * @return \Illuminate\Http\Response
    */
    public function restore(Profile $profile, Opportunity $opportunity)
    {
        $relationship = $opportunity->relationship();
        if ($relationship->profile_id == $profile->id)
        {
            $opportunity->restore();
            return response()->json('Ok', 200);
        }

        return response()->json('Resource not found', 401);
    }
}
