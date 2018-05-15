<?php

namespace App\Http\Controllers;

use App\Contract;
use App\Profile;
use Illuminate\Http\Request;

class ContractController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index(Profile $profile,$skip)
  {
    $contract = Contract::skip($skip)
    ->take(100)->get();

    return response()->json($contract);
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create()
  {
    //
  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function store(Profile $profile,Request $request)
  {
    $contract =  $request->id == 0 ? new Contract() : Contract::where('id', $request->id)->first();



    $contract->name = $request->name;
    $contract->country ='PRY';



    $contract->save();
  }

  /**
  * Display the specified resource.
  *
  * @param  \App\Contract  $contract
  * @return \Illuminate\Http\Response
  */
  public function show(Contract $contract)
  {
    //
  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  \App\Contract  $contract
  * @return \Illuminate\Http\Response
  */
  public function edit(profile $profile,Contract $contract)
  {
      return response()->json(Contract::where('id',$contract->id)->with('details')->first());
  }

  /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  \App\Contract  $contract
  * @return \Illuminate\Http\Response
  */
  public function update(Request $request, Contract $contract)
  {
    //
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  \App\Contract  $contract
  * @return \Illuminate\Http\Response
  */
  public function destroy(Contract $contract)
  {
    //
  }
}
