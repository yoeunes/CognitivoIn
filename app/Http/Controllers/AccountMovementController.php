<?php

namespace App\Http\Controllers;
use App\Account;
use App\Profile;
use App\AccountMovement;
use App\Relationship;
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

    public function ReceivePayment(Request $request,Profile $profile)
    {

      $account = Account::where('number',1)->first()==null?new Account():
          Account::where('number',1)->first();
          $account->name = "Cash A/c Of " . $profile->name;
          $account->number = "1";
          $account->currency ='PRY';
          $account->save();

          $accountmovement = new AccountMovement();
          $accountmovement->schedual_id = $request['schedual_id'];
          $accountmovement->user_id = $request['id'];
          $accountmovement->account_id = $account->id;
          $accountmovement->type_id = $request['Type'];
          $accountmovement->currency = 'PRY';
          $accountmovement->currency_rate = 1;
          $accountmovement->date = Carbon::now();

          if ($request['Type'] == 1)
          {
              $accountmovement->credit = $request['Value'];
              $accountmovement->debit = 0;
          }
          else
          {
              $accountmovement->credit = 0;
              $accountmovement->debit = $request['Value'];
          }
          $accountmovement->save();
 return response()->json($accountmovement, '200');
          $data2 = [];

          $data2[] = [
              'PaymentReference' => $accountmovement->id,
              'ResponseType' => 1
          ];
          return response()->json($data2, '200');
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
