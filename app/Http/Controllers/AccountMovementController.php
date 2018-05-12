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
    public function index(Profile $profile, $skip)
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
<<<<<<< HEAD
        $account = Account::where('profile_id', $profile->id)
        ->where('type', $request['PaymentType'])
        ->first();
=======
        $account = Account::where('profile_id', $profile->id)->first() ?? new Account();
>>>>>>> parent of b580b54... update

        if (isset($account))
        {
            $account = new Account()
            $account->profile_id = $profile->id;
            $account->name = "Cash Account for " . $profile->name;
            $account->number = "...";
            $account->currency = $profile->currency;
            $account->save();
        }

<<<<<<< HEAD
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
=======
        $schedual = Schedual::find($request['InvoiceReference']);

        if (isset($schedual))
        {
            $accountMovement = new AccountMovement();
            $accountMovement->schedual_id = $schedual->id;
            $accountMovement->user_id = $request['UserID'];
            $accountMovement->account_id = $account->id;
            $accountMovement->location_id = null;
            $accountMovement->type = $request['Type'] ?? 1;
            $accountMovement->currency = $request['Currency'];

            if ($request['Currency'] != $schedual->currency)
            { $accountMovement->currency_rate = Swap::latest($schedual->currency . '/' . $request['Currency'])->getValue(); }
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
        }
>>>>>>> parent of b580b54... update

        $accountMovement->save();

        $return = [];
        $return[] = [
            'PaymentReference' => $accountMovement->id,
            'ResponseType' => 1
        ];

        return response()->json($return, 200);
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
<<<<<<< HEAD
=======

    public function annull(Request $request, Profile $profile)
    {
        $accountMovement = AccountMovement::find($request['InvoiceReference'])
        ->with('account')
        ->first();


        if (isset($accountMovement))
        {
            $account = $accountMovement->account();

            //Make sure that profile requesting change is owner of account movement. if not,
            //we cannot allow user to delete something that does not belong to them.
            if ($account->profile_id == $profile->id)
            {
                $accountMovement->status = 3;
                $accountMovement->comment = $request['Comment'];
                $accountMovement->save();
            }
        }

        return response()->json('Unkown Movement', '401');
    }
>>>>>>> parent of b580b54... update
}
