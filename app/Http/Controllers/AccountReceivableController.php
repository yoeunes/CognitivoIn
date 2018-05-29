<?php

namespace App\Http\Controllers;

use App\Schedule;
use App\Account;
use App\Profile;
use App\AccountMovement;
use App\Relationship;
use DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Swap\Laravel\Facades\Swap;

class AccountReceivableController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(Profile $profile, $skip)
    {

        $schedule = Schedule::with('relationship')->
        skip($skip)
        ->take(100)
        ->get();

        return response()->json($schedule);
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
        $return = [];
        $account = Account::where('id',$request->account_id)->first();

        if (!isset($account))
        {
            $account = Account::where('profile_id', $profile->id)->first();

            if (!isset($account))
            {
                $account = new Account();
                $account->profile_id = $profile->id;
                $account->name = "Cash Account for " . $profile->name;
                $account->number = "...";
                $account->currency = $profile->currency;
                $account->save();
            }

        }

        $schedual = Schedule::where('id',$request->InvoiceNumber)->first();

        if (isset($schedual))
        {
            $accountMovement = new AccountMovement();
            $accountMovement->schedule_id = $request->InvoiceNumber;
            $accountMovement->account_id = $account->id;
            $accountMovement->user_id = $request->user_id ?? null;
            $accountMovement->location_id = $request->location_id ?? null;
            $accountMovement->type = $request->payment_type ?? 1;
            $accountMovement->currency = $request->currency;

            if ($request['Currency'] != $schedual->currency)
            { $accountMovement->currency_rate = Swap::latest($schedual->currency . '/' . $request->currency)->getValue(); }
            else
            { $accountMovement->currency_rate = 1; }

            $accountMovement->date = $request->date ?? Carbon::now();
            $accountMovement->credit = $request->value;
            $accountMovement->debit = 0;

            $accountMovement->save();

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
        $account = $accountMovement->account;
        $schedual = Schedual::find($request['ReferenceID']);

        //check if profile belongs to account to avoid incorrect data manipulation
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
            $accountMovement->credit = $request['Value'];
            $accountMovement->debit = 0;

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
    public function destroy(Profile $profile, AccountMovement $accountMovement)
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

    public function search(Request $request, Profile $profile)
    {
        $return = [];

        //return payment schedual. history of unpaid debt. by Customer TaxID
        $relationship = Relationship::GetCustomers()
        ->where(function ($q) use ($request)
        {
            $q->where('customer_alias', $request->customer_alias)
            ->orWhere('customer_taxid', $request->customer_taxid);
        })
        ->first();

        if (isset($relationship))
        {
            $scheduals = Schedule::where('relationship_id', $relationship->id)->get();

            $values = [];
            $j = 0;

            foreach ($scheduals as $schedule)
            {
                $values[$j] = [
                    'CurrencyCode' => $schedule->currency,
                    'Value' => $schedule->getBalance(),
                    'ReferenceCode' => $schedule->reference,
                    'InvoiceNumber' => $schedule->id,
                    'InvoiceDate' => $schedule->date,
                    'Deadline' => $schedule->due_date,
                ];

                $j = $j + 1;
            }

            //for each currency requested, run loop and add into array
            $return[] =
            [
                'ReferenceName' => $request->customer_alias,
                'ReferenceTaxID' => $request->customer_taxid,
                'Details' => $values
            ];

            return response()->json($return, 200);
        }

        return response()->json('Resource not found.', 401);
    }
    public function annull(Request $request, Profile $profile,$id)
    {
        $accountMovement = AccountMovement::where('id',$id)
        ->with('account')
        ->first();
        if (isset($accountMovement))
        {
            $account = $accountMovement->account;
            //Make sure that profile requesting change is owner of account movement. if not,
            //we cannot allow user to delete something that does not belong to them.
            if (isset($account))
            {
                if ($account->profile_id == $profile->id)
                {
                    $accountMovement->status = 3;
                    $accountMovement->comment = $request['Comment'];
                    $accountMovement->save();
                    return response()->json('Annulled', 200);
                }
            }
        }
        return response()->json('Resource not found', 404);
    }
}
