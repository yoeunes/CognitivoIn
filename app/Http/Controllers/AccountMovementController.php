<?php

namespace App\Http\Controllers;
use App\Account;
use App\Profile;
use App\AccountMovement;
use App\Relationship;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Swap\Laravel\Facades\Swap;
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
    public function store(Request $request, Profile $profile)
    {
        $account = Account::where('number', 1)->first() ?? new Account();

        $account->name = "Cash A/C Of " . $profile->name;
        $account->number = "1";
        $account->currency ='PRY';
        $account->save();

        $accountMovement = new AccountMovement();
        $accountMovement->schedual_id = $request['InvoiceReference'];
        $accountMovement->user_id = $request['id'];
        $accountMovement->account_id = $account->id;
        $accountMovement->location_id = null;
        $accountMovement->type = $request['Type'] ?? 1;
        $accountMovement->currency = $request['Currency'];

        if ($request['Currency'] != $profile->currency))
        { $accountMovement->currency_rate = Swap::latest($profile->currency . '/' . $request['Currency'])->getValue(); }
        else
        { $accountMovement->currency_rate = 1; }

        $accountMovement->date = Carbon::now();
        $accountMovement->credit = $request['Type'] == 1 ? $request['Value'] : 0;
        $accountMovement->debit = $request['Type'] == 1 ? 0 : $request['Value'];

        $accountMovement->save();

        $return = [];
        $return[] = [
            'PaymentReference' => $accountMovement->id,
            'ResponseType' => 1
        ];

        return response()->json($return, '200');
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
            }
        }

        return response()->json('Unkown Movement', '401');
    }

    public function annull(Request $request, Profile $profile)
    {
        $accountMovement = AccountMovement::find($request)
        ->with('account')
        ->first();

        if (isset($accountMovement))
        {
            $account = $accountMovement->account;

            //Make sure that profile requesting change is owner of account movement. if not,
            //we cannot allow user to delete something that does not belong to them.
            if ($account->profile_id == $profile->id)
            {
                $accountMovement->status = 3
                $accountMovement->comment = $request['Comment'];
                $accountMovement->save();
            }
        }

        return response()->json('Unkown Movement', '401');
    }
}
