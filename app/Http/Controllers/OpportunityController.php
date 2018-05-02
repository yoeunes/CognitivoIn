<?php

namespace App\Http\Controllers;

use App\Opportunity;
use App\OpportunityActivity;
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
    public function index(Profile $profile)
    {
        $pipelines = Pipeline::get();

        $opportunities = Opportunity::Mine()
        ->select('opportunities.id', 'opportunities.description', 'opportunities.deadline_date', 'opportunities.value',
        'relationships.customer_alias', 'relationships.customer_taxid')
        ->get();

        return view('company.sales.opportunities.list')
        ->with('opportunities', $opportunities)
        ->with('pipelines', $pipelines);
    }
    public function list_opportunities(Profile $profile,$skip)
    {

       $opportunities = Opportunity::Mine()
        ->select('opportunities.id', 'opportunities.description', 'opportunities.deadline_date', 'opportunities.value',
        'relationships.customer_alias', 'relationships.customer_taxid')
          ->skip($skip)
        ->take(100)->get();

      return response()->json($opportunities);
    }
    public function list_opportunitiesByID(Profile $profile,$id)
    {


       $opportunities = Opportunity::Mine()
        ->select('opportunities.id', 'opportunities.description', 'opportunities.deadline_date', 'opportunities.value',
        'relationships.customer_alias', 'relationships.customer_taxid')

      ->where('id',$id)

        ->get();


      return response()->json($opportunities);
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create(Profile $profile)
    {
        $customers = Relationship::GetCustomers()->get();
        $stages = PipelineStage::get();

        return view('company.sales.opportunities.form')
        ->with('customers',$customers)
        ->with('stages',$stages);
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request, Profile $profile)
    {
        $opportunity = $request->id == 0 ? new Opportunity()
        : Opportunity::where('id', $request->id)->first();


        $customers = Relationship::GetCustomers()
        ->where('id', '=', $request->relationship_id)

        ->first();
        $opportunity->relationship_id = $customers->id;
        $opportunity->stage_id = $request->stage_id;
        $opportunity->deadline_date = $request->deadline_date;
        $opportunity->description = $request->description;
        $opportunity->status = 1;
        $opportunity->value = $request->value;
        $opportunity->save();

        return redirect()->route('opportunities.index', $profile);
    }

    /**
    * Display the specified resource.
    *
    * @param  \App\opportunity  $opportunity
    * @return \Illuminate\Http\Response
    */
    public function show(Profile $profile, $opportunityID)
    {
        $opportunity = Opportunity::find($opportunityID);

        $opportunity_activities = OpportunityActivity::
        where('opportunity_id', $opportunityID)
        ->where('completed', false)
        ->get();

        $opportunitiesinactive = OpportunityActivity::
        where('opportunity_id', $opportunityID)
        ->where('completed', true)
        ->get();

        return view('company.sales.opportunities.show')
        ->with('opportunity',$opportunity)
        ->with('opportunity_activities',$opportunity_activities)
        ->with('opportunitiesinactive',$opportunitiesinactive);
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\opportunity  $opportunity
    * @return \Illuminate\Http\Response
    */
    public function edit(opportunity $opportunity)
    {
        //
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\opportunity  $opportunity
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, Opportunity $opportunity)
    {
        //
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\opportunity  $opportunity
    * @return \Illuminate\Http\Response
    */
    public function destroy(Opportunity $opportunity)
    {
        //
    }
}
