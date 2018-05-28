<?php

namespace App\Http\Controllers;

use App\Account;
use App\Profile;
use App\Scheduals;
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
        $return = ['Invoice Not Found ...'];
        $account = Account::where('profile_id', $profile->id)
        ->first();

        if (!isset($account))
        {
            $account = new Account();
            $account->profile_id = $profile->id;
            $account->name = "Cash Account for " . $profile->name;
            $account->number = "...";
            $account->currency = $profile->currency;
            $account->save();
        }

        $schedual = Scheduals::where('id',$request['InvoiceReference'])->first();

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


            $return = [
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
                return response()->json('Ok', 200);
            }
        }

        return response()->json('Unkown Resource', 401);
    }


    public function annull(Request $request, Profile $profile)
    {
        $accountMovement = AccountMovement::where('schedual_id',$request['InvoiceReference'])
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

                return response()->json('Ok', 200);
            }
        }

        return response()->json('Unkown Resource', 401);
    }

    public function makePayment(Request $request)
    {
        $data = $request[0];

        if (isset($data) == false)
        {
            $data = $request;
        }

        $profile = request()->route('profile');


        $account = Account::first();

        if ($account != null)
        {
            $account = new Account();
            $account->profile_id = $profile->id;
            $account->name = "Cash A/C Of " . $profile->name;
            $account->number = "xxx";
            $account->currency = $profile->currency;
            $account->save();
        }

        $schedules = DB::select('
        select
        scheduals.currency as code, (scheduals.debit-(select if(sum(credit) is null,0,sum(credit)) from account_movements where `account_movements`.`status` != 3
        and `scheduals`.`id` = `account_movements`.`schedual_id`)) as value,
        scheduals.id , scheduals.date as InvoiceDate, scheduals.date_exp as Deadline,
        scheduals.reference as Reference from `scheduals`
        where `relationship_id` = '. $order->relationship_id . ' and `scheduals`.`deleted_at` is null and (scheduals.debit-(select if(sum(credit) is null,0,sum(credit)) from account_movements where `account_movements`.`status` != 3
        and `scheduals`.`id` = `account_movements`.`schedual_id`)) >0  order by scheduals.date_exp');

        $schedules = collect($schedules);
        $balance = $amount;

        for ($i = 0; $i < count($schedules) ; $i++)
        {
            if ($balance > 0)
            {
                $accountMovement = new AccountMovement();
                $accountMovement->schedual_id = $schedules[$i]->id;
                $accountMovement->account_id = $account->id;
                $accountMovement->type = $type;
                $accountMovement->currency = $data->currency;
                $accountMovement->currency_rate = ($data->rate ?? Swap::latest($profile->currency . '/' . $data->currency)->getValue()) ?? 1;
                $accountMovement->date = Carbon::parse($data->date);

                if ($schedules[$i]->value > $balance)
                {
                    $value = $balance;
                    $balance = 0;
                }
                else
                {
                    $value = $schedules[$i]->value;
                    $balance = $balance - $schedules[$i]->value;
                }

                $accountMovement->credit = $value;
                $accountMovement->debit = 0;

                $accountMovement->save();
            }
        }
    }
}
