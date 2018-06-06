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
        $account = Account::where('id', $request->AccountId)->first();

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

        $schedual = Schedule::where('id', $request->InvoiceNumber)->first();

        if (isset($schedual))
        {
            $accountMovement = new AccountMovement();
            $accountMovement->schedule_id = $request->InvoiceNumber;
            $accountMovement->account_id = $account->id;
            $accountMovement->location_id = $request->LocationId ?? null;
            $accountMovement->type = $request->PaymentType ?? 1;
            $accountMovement->currency = $request->Currency;

            if ($request['Currency'] != $schedual->currency)
            { $accountMovement->currency_rate = Swap::latest($schedual->currency . '/' .$request->Currency)->getValue(); }
            else
            { $accountMovement->currency_rate = 1; }

            $accountMovement->date = $request->Date ?? Carbon::now();
            $accountMovement->credit = $request->Value;
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

    public function search(Profile $profile, $query)
    {
        $return = [];

        //return payment schedual. history of unpaid debt. by Customer TaxID
        $relationship = Relationship::GetCustomers()
        ->where(function ($q) use ($query)
        {
            $q->where('customer_alias', 'LIKE', '%' . $query . '%')
            ->orWhere('customer_taxid', $query);
        })
        ->first();

        if (isset($relationship))
        {
            //Bring only scheduals with positive balance. To make it less heavy.
            $schedules = Schedule::where('relationship_id', $relationship->id)
            //->where('balance', '>', 0)
            ->get();
            $schedules=collect($schedules);
            $schedules=$schedules->where('balance', '>', 0);
            $values = [];
            $j = 0;

            foreach ($schedules as $schedule)
            {
                $values[$j] = [
                    'CurrencyCode' => $schedule->currency,
                    'Value' => $schedule->balance,
                    'ReferenceCode' => $schedule->reference,
                    'InvoiceNumber' => $schedule->id,
                    'InvoiceDate' => $schedule->date,
                    'Deadline' => $schedule->due_date

                ];

                $j = $j + 1;
            }

            //for each currency requested, run loop and add into array
            $return[] =
            [
                'Customer' => $relationship->customer_alias,
                'CustomerTaxID' => $relationship->customer_taxid,
                'Details' => $values
            ];

            return response()->json($return, 200);
        }

        return response()->json('Customer not found.', 404);
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
                    $accountMovement->delete();

                    return response()->json('Payment Annulled', 200);
                }
            }
        }

        return response()->json('Payment not found', 404);
    }
}
