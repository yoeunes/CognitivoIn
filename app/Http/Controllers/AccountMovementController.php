<?php

namespace App\Http\Controllers;

use App\AccountMovement;
use App\Relationship;
use App\Currency;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AccountMovementController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        //
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
        //
    }

    /**
    * Display the specified resource.
    *
    * @param  \App\AccountMovement  $accountMovement
    * @return \Illuminate\Http\Response
    */
    public function show(AccountMovement $accountMovement)
    {
        //
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\AccountMovement  $accountMovement
    * @return \Illuminate\Http\Response
    */
    public function edit(AccountMovement $accountMovement)
    {
        //
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\AccountMovement  $accountMovement
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, AccountMovement $accountMovement)
    {
        //
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\AccountMovement  $accountMovement
    * @return \Illuminate\Http\Response
    */
    public function destroy(AccountMovement $accountMovement)
    {
        //
    }

    public function ReceivePayment(Request $request,$profile)
    {
        //
        // if ($type==1)
        // {
        //     $relationship =  Relationship::join('profiles', 'relationships.supplier_id', 'profiles.id')
        //     ->where('supplier_id', $profile)
        //     ->where('supplier_accepted', true)->where(function ($q) use ($partnerName,$partnerTaxID)
        //     {
        //         $q->where('name', $partnerName)
        //         ->orWhere('taxid', $partnerTaxID);
        //
        //     })->select('relationships.id')->first();
        // }
        // else
        // {
        //     $relationship =  Relationship::join('profiles', 'relationships.customer_id', 'profiles.id')
        //     ->where('customer_id', $profile)
        //     ->where('customer_accepted', true)->where(function ($q) use ($partnerName,$partnerTaxID)
        //     {
        //         $q->where('name', $partnerName)
        //         ->orWhere('taxid', $partnerTaxID);
        //     })->select('relationships.id')->first();
        // }
        //
        // $currency=Currency::where('code',$CurrencyCode)->first();
        // if (isset($relationship) and isset($currency)) {
        //     $accountmovement = new AccountMovement();
        //     $accountmovement -> currency_id = $currency->id;
        //     $accountmovement -> currency_rate = $currency->exchange_rate;
        //     $accountmovement -> user_id = $profile;
        //     $accountmovement -> type_id = 1;
        //
        //     $accountmovement -> date = Carbon::now();
        //     if ($type==1) {
        //         $accountmovement -> credit = $Value;
        //     }
        //     else {
        //         $accountmovement -> debit = $Value;
        //     }
        //     $accountmovement -> reference =$InvoiceReference;
        //     $accountmovement->save();
        //     return response()->json($accountmovement,'200');
        //
        // }
        // return response()->json(null,'200');

        $data2 = [];

        $data2[] = [
            'PaymentReference' => '15',
            'ResponseType' => 1
        ];
        return response()->json($data2,'200');
    }
    public function Anull(Request $request)
    {

        // $accountMovement = AccountMovement::where('reference',$InvoiceReference)->first();
        // if (isset($accountMovement)) {
        //     $accountMovement->delete();
        // }
        // return response()->json(2,'200');

        return response()->json('200',200);
    }
}
