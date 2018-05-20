<?php

namespace App\Http\Controllers;

use App\OpportunityMember;
use Illuminate\Http\Request;

class OpportunityMemberController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(Profile $profile, $skip, $filterBy)
    {
        $opportunityMembers = OpportunityMember::My()
        ->skip($skip)
        ->take(100)
        ->get();

        return response()->json($opportunityMembers);
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        $opportunityMembers = new OpportunityMember();
        $opportunityMembers->opportunity_id = $request->opportunity_id;
        $opportunityMembers->profile_id = $request->profile_id;
        $opportunityMembers->save();

        return response()->json('Ok', 200);
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\OpportunityMember  $opportunityMember
    * @return \Illuminate\Http\Response
    */
    public function destroy(OpportunityMember $opportunityMember)
    {
        //No authentication check, figure out later based on user role if they can delete or not.
        //No need for soft delete.
        $opportunity->forceDelete();
        return response()->json('Ok', 200);
    }
}