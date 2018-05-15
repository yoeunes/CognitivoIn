<?php

namespace App\Http\Controllers;

use App\Contract;
use App\ContractDetail;
use Illuminate\Http\Request;

class ContractDetailController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {

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
  public function store(Request $request)
  {
    $contractdetail = $request->detail_id == 0 ? new ContractDetail() :
    ContractDetail::where('id',$request->detail_id)->first();;

    if ($request->id==0) {
      $contract= new Contract();
      $contract->name = $request->name;
      $contract->country ='PRY';
      $contract->save();
      $contractdetail->contract_id =  $contract->id;
    }
    else {
          $contractdetail->contract_id =  $request->id;
    }


    $contractdetail->Offset = $request->offset;

    $contractdetail->percent = $request->percent;

    $contractdetail->save();

    return response()->json(ContractDetail::where('contract_id',  $contractdetail->contract_id)->get(),200);
  }

  /**
  * Display the specified resource.
  *
  * @param  \App\ContractDetail  $contractDetail
  * @return \Illuminate\Http\Response
  */
  public function show(ContractDetail $contractDetail)
  {
    //
  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  \App\ContractDetail  $contractDetail
  * @return \Illuminate\Http\Response
  */
  public function edit(ContractDetail $contractDetail)
  {
    //
  }

  /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  \App\ContractDetail  $contractDetail
  * @return \Illuminate\Http\Response
  */
  public function update(Request $request, ContractDetail $contractDetail)
  {
    //
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  \App\ContractDetail  $contractDetail
  * @return \Illuminate\Http\Response
  */
  public function destroy(ContractDetail $contractDetail)
  {
    //
  }
}
