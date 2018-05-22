<?php

namespace App\Http\Controllers;

use App\Vat;
use App\VatDetail;
use App\Profile;
use Illuminate\Http\Request;

class VatController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(Profile $profile,$skip)
    {
        $location = Vat::with('details')->skip($skip)
        ->take(100)->get();

        return response()->json($location);
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
        $vat =  $request->id == 0 ? new Vat() : Vat::where('id', $request->id)->first();
        $vat->profile_id = $profile->id;


        $vat->name = $request->name;
        $vat->country ='PRY';
        $vat->applied_on=1;


        $vat->save();

        $details = collect($request->details);

        foreach ($details as $row)
      {
          $detail = VatDetail::where('id', $row['id'])->first()
          ?? new VatDetail();
          $detail->vat_id = $vat->id;
          $detail->percent = $row['percent'];
          $detail->coefficient = $row['coefficient'];
          $detail->save();


      }
    }

    /**
    * Display the specified resource.
    *
    * @param  \App\Vat  $vat
    * @return \Illuminate\Http\Response
    */
    public function show(Vat $vat)
    {
        //
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Vat  $vat
    * @return \Illuminate\Http\Response
    */
    public function edit(Profile $profile,Vat $vat)
    {
      return response()->json(Vat::where('id',$vat->id)->with('details')->first());

    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Vat  $vat
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, Vat $vat)
    {
        //
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Vat  $vat
    * @return \Illuminate\Http\Response
    */
    public function destroy(Vat $vat)
    {
        //
    }
}
