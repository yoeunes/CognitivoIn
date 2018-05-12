<?php

namespace App\Http\Controllers;

use App\Scheduals;
use App\Account;
use App\Profile;
use App\AccountMovement;
use App\Relationship;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Swap\Laravel\Facades\Swap;

class AccountPayableController extends Controller
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
  public function store(Request $request, Profile $profile)
  {
    $account = Account::where('profile_id', $profile->id)
    ->where('type', $request['PaymentType'])
    ->first();

    if (isset($account))
    {
      $account = new Account()
      $account->type=$request['PaymentType'];
      $account->profile_id = $profile->id;
      $account->name = "Cash Account for " . $profile->name;
      $account->number = "...";
      $account->currency = $profile->currency;
      $account->save();
    }

    $schedual = Scheduals::find($request['ReferenceID']);

    if (isset($schedual))
    {
      $accountMovement = new AccountMovement();
      $accountMovement->schedual_id = $request['ReferenceID'];
      $accountMovement->account_id = $account->id;
      $accountMovement->user_id = $request['UserID'] ?? null;
      $accountMovement->location_id = $request['LocationID'] ?? null;
      $accountMovement->type = $request['PaymentType'] ?? 1;
      $accountMovement->currency = $request['Currency'];

      if ($request['Currency'] != $schedual->currency)
      { $accountMovement->currency_rate = Swap::latest($schedual->currency . '/' . $request['Currency'])->getValue(); }
      else
      { $accountMovement->currency_rate = 1; }

      $accountMovement->date = $request['Date'] ?? Carbon::now();
      $accountMovement->credit = 0;
      $accountMovement->debit = $request['Value'];

      $accountMovement->save();

      $return = [];
      $return[] = [
        'PaymentReference' => $accountMovement->id,
        'ResponseType' => 1
      ];
    }

    return response()->json($return, 200);
  }

  /**
  * Display the specified resource.
  *
  * @param  \App\AccountMovement  $accountMovement
  * @return \Illuminate\Http\Response
  */
  public function show(Profile $profile, AccountMovement $accountMovement)
  {
    return AccountMovement::find($accountMovement->id);
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
  public function update(Request $request, Profile $profile, AccountMovement $accountMovement)
  {
    $schedual = Schedual::find($request['ReferenceID']);

    if (isset($accountMovement) && isset($schedual))
    {
      $accountMovement->schedual_id = $request['ReferenceID'];
      $accountMovement->account_id = $request['AccountID'];
      $accountMovement->user_id = $request['UserID'] ?? null;
      $accountMovement->location_id = $request['LocationID'] ?? null;
      $accountMovement->type = $request['PaymentType'] ?? 1;
      $accountMovement->currency = $request['Currency'];

      if ($request['Currency'] != $schedual->currency)
      { $accountMovement->currency_rate = Swap::latest($schedual->currency . '/' . $request['Currency'])->getValue(); }
      else
      { $accountMovement->currency_rate = 1; }

      $accountMovement->date = $request['Date'] ?? Carbon::now();
      $accountMovement->credit = 0;
      $accountMovement->debit = $request['Value'];

      $accountMovement->save();

      $return[] = [
        'PaymentReference' => $accountMovement->id,
        'ResponseType' => 1
      ];

      return response()->json($return, 200);
    }

    return response()->json('Resource not found', 404);
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  \App\AccountMovement  $accountMovement
  * @return \Illuminate\Http\Response
  */
  public function destroy(AccountMovement $accountMovement, Profile $profile)
  {
    if (isset($accountMovement))
    {
      $account = $accountMovement->account;

      //Make sure that profile requesting change is owner of account movement. if not,
      //we cannot allow user to delete something that does not belong to them.
      if ($account->profile_id == $profile->id)
      {
        $accountMovement->delete();
        return response()->json('Deleted', 200);
      }
    }

    return response()->json('Resource not found', 404);
  }

  public function annull(Request $request, Profile $profile)
  {
    $accountMovement = AccountMovement::find($request['PaymentReferenceID'])
    ->with('account')
    ->first();

    if (isset($accountMovement))
    {
      $account = $accountMovement->account;

      //Make sure that profile requesting change is owner of account movement. if not,
      //we cannot allow user to delete something that does not belong to them.
      if ($account->profile_id == $profile->id)
      {
        $accountMovement->status = 3;
        $accountMovement->comment = $request['Comment'];
        $accountMovement->save();

        return response()->json('Annulled', 200);
      }
    }

    return response()->json('Resource not found', 404);
  }
}
