<?php

namespace App\Http\Controllers;

use App\Contract;
use App\ContractDetail;
use App\Profile;
use Illuminate\Http\Request;

class ContractController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(Profile $profile, $skip, $filter)
    {
        $contract = Contract::skip($skip)
        ->take(100)
        ->get();

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
    public function store(Profile $profile, Request $request)
    {
        $contract = Contract::where('id', $request->id)->first() ?? new Contract();

        $contract->name = $request->name;
        //$contract->profile_id = $profile->id;
        $contract->country = $profile->country;
        $contract->save();

        $totalPercent = 0;

        foreach ($contract->details as $reqDetail)
        {
            $detail = ContractDetail::where('id', $reqDetail->id)->first() ?? new ContractDetail();
            $detail->contract_id = $contract->id;
            $detail->percent = $reqDetail->percent;
            $detail->offset = $reqDetail->offset;
            $detail->save();

            $totalPercent += $reqDetail->percent;
        }
        //this code adds the remaining balance to the end.
        if ($totalPercent < 1 && isset($contract->details->last()))
        {
            $detail = $contract->details()->last();
            $detail->percent = $detail->percent + (1 - $totalPercent);
            $detail->save();
        }

        return response()->json('Ok', 200);
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
    public function edit(Profile $profile, Contract $contract)
    {
        $contract = Contract::where('id', $contract->id)
        ->with('details')
        ->first();

        return response()->json($contract);
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
    public function destroy(Profile $profile, Contract $contract)
    {
        if ($contract->profile_id == $profile->id)
        {
            $contract->delete();
            return response()->json('200', 200);
        }

        return response()->json('Resource not found', 401);
    }
}
