<?php

namespace App\Http\Controllers;
use App\Vat;
use App\VatDetail;
use App\Profile;
use Illuminate\Http\Request;

class VatDetailController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    $vatdetails = VatDetail::get();

    return response()->json($vatdetails);
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
    $vatdetail = $request->detail_id == 0 ? new VatDetail() :
    VatDetail::where('id',$request->detail_id)->first();;

    if ($request->id==0) {
      $vat= new Vat();
      $vat->profile_id = $profile->id;
      $vat->name = $request->name;
      $vat->country ='PRY';
      $vat->applied_on=1;
      $vat->save();
      $vatdetail->vat_id =  $vat->id;
    }
    else {
      $vatdetail->vat_id =  $request->id;
    }


    $vatdetail->coefficient = $request->coefficient;

    $vatdetail->percent = $request->percent;

    $vatdetail->save();

    return response()->json(VatDetail::where('vat_id',$vatdetail->vat_id)->get(),200);
  }

  /**
  * Display the specified resource.
  *
  * @param  \App\VatDetail  $vatDetail
  * @return \Illuminate\Http\Response
  */
  public function show(VatDetail $vatDetail)
  {
    //
  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  \App\VatDetail  $vatDetail
  * @return \Illuminate\Http\Response
  */
  public function edit(VatDetail $vatDetail)
  {
    //
  }

  /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  \App\VatDetail  $vatDetail
  * @return \Illuminate\Http\Response
  */
  public function update(Request $request, VatDetail $vatDetail)
  {
    //
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  \App\VatDetail  $vatDetail
  * @return \Illuminate\Http\Response
  */
  public function destroy(VatDetail $vatDetail)
  {
    //
  }
}
