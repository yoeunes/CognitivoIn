<?php

namespace App\Http\Controllers;

use App\Account;
use App\Profile;
use App\Schedule;
use App\AccountMovement;
use App\Relationship;
use App\Order;
use App\OrderDetail;
use App\VatDetail;
use App\Http\Resources\AccountMovementResource;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use Swap\Laravel\Facades\Swap;

class AccountMovementController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index(Profile $profile, $filterBy)
  {
    return AccountMovementResource::collection(
      AccountMovement::with('account')->orderBy('created_at')->paginate(25));

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
        { $accountMovement->currency_rate = Swap::latest($schedual->currency . '/' . $request['Currency'])->getValue() ?? 1; }
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
    public function destroy(Profile $profile, AccountMovement $accountMovement )
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

      $accountMovement = AccountMovement::where('schedual_id', $request['InvoiceReference'])
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

          //finally perform a softdelete.
          $accountMovement->delete();

          return response()->json('Ok', 200);
        }
      }

      return response()->json('Unkown Resource', 401);
    }

    public function makePayment(Request $request)
    {
      $data = $request[0];

      if (isset($data) == false)
      { $data = $request; }

      $order = Order::where('id', $data->id)->with('details')->first();
      $amount=0;
      $vatAmount=0;
      foreach ($order->details as  $detail)
      {
        $vatDetails = VatDetail::where('vat_id', $detail->vat_id)->get();

        foreach ($vatDetails as $vat)
        {
          $vatAmount = $vatAmount + (($detail->unit_price * $vat->percent) *  $vat->coefficient);
        }

        $amount = $amount + (($detail->unit_price + $vatAmount) * $detail->quantity);
      }

      $profile = request()->route('profile');
      $account = Account::first();

      if ($account == null)
      {
        $account = new Account();
        $account->profile_id = $profile->id;
        $account->name = "Cash A/C of " . $profile->name;
        $account->number = "xxx";
        $account->currency = $profile->currency;
        $account->save();
      }

      //Run code to check actual balance.
      $scheduals = Schedule::where('relationship_id', $order->relationship_id)->get();
      // $schedules = DB::select('
      // select
      // schedule.currency as code,
      // (schedule.value - (select if(sum(credit) is null,0,sum(credit)) from account_movements where account_movements.status != 3 and schedule.id = account_movements.schedual_id)) as value,
      // schedule.id,
      // schedule.date as InvoiceDate,
      // schedule.due_date as Deadline,
      // schedule.reference as Reference from schedule
      // where relationship_id = ' . $data->relationship_id . '
      // and schedule.deleted_at is null
      // and (schedule.value - (select if(sum(credit) is null, 0, sum(credit)) from account_movements where account_movements.status != 3
      // and schedule.id = account_movements.schedual_id)) > 0  order by schedule.due_date');


      $balance = $amount;

      for ($i = 0; $i < count($scheduals); $i++)
      {
        if ($balance > 0)
        {
          $accountMovement = new AccountMovement();
          $accountMovement->schedule_id = $scheduals[$i]->id;
          $accountMovement->account_id = $account->id;
          $accountMovement->type = 1;
          $accountMovement->currency = $data->currency;
          $accountMovement->currency_rate = ($data->rate ?? Swap::latest($profile->currency . '/' . $data->currency)->getValue()) ?? 1;
          $accountMovement->date =$data->date? Carbon::parse($data->date):Carbon::now();

          //Schedual Value is greater than balance, then make balance 0.
          if ($scheduals[$i]->balance > $balance)
          {
            $value = $balance;
            $balance = 0;
          }
          else
          {
            $value = $scheduals[$i]->value;
            $balance = $balance - $scheduals[$i]->value;
          }

          $accountMovement->credit = $value;
          $accountMovement->debit = 0;

          $accountMovement->save();
        }
      }
    }

    public function receivePayment(Request $request)
    {
      $data = $request[0];

      if (isset($data) == false)
      { $data = $request; }

      $profile = request()->route('profile');
      $account = $data['account_id'];

      if ($account != null)
      {
        $account = new Account();
        $account->profile_id = $profile->id;
        $account->name = "Cash A/C of " . $profile->name;
        $account->number = "xxx";
        $account->currency = $profile->currency;
        $account->save();
      }

      //Run code to check actual balance.
      $scheduals = Schedual::where('order_id', $data->id)->get();
      $order=Order::where('id', $data->id)->with('detail')->first();

      $balance = $order->detail->sum('quantity') * $order->detail->sum('unit_price');

      for ($i = 0; $i < count($schedules); $i++)
      {
        if ($balance > 0)
        {
          $accountMovement = new AccountMovement();
          $accountMovement->schedual_id = $schedules[$i]->id;
          $accountMovement->account_id = $account->id;
          $accountMovement->type = 1;
          $accountMovement->currency = $data->currency;
          $accountMovement->currency_rate = ($data->rate ?? Swap::latest($profile->currency . '/' . $data->currency)->getValue()) ?? 1;
          $accountMovement->date = Carbon::parse($data->date);

          //Schedual Value is greater than balance, then make balance 0.
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

          $accountMovement->credit = 0;
          $accountMovement->debit = $value;

          $accountMovement->save();
        }
      }
    }

    public function Movement(Profile $profile,Request $request)
    {

      if ($request->category==1)
      {
        $accountMovement= new AccountMovement();
        $accountMovement->account_id=$request->account_id;
        $accountMovement->location_id=$request->fromLocationid;
        $accountMovement->debit=$request->quantity;
        $accountMovement->credit=0;
        $accountMovement->date=Carbon::now();
        $accountMovement->currency = $request->currency;
        $accountMovement->currency_rate = ($request->rate ?? Swap::latest($profile->currency . '/' . $request->currency)->getValue()) ?? 1;
        $accountMovement->save();

        $accountMovement= new AccountMovement();
        $accountMovement->account_id=$request->account_id;
        $accountMovement->location_id=$request->fromLocationid;
        $accountMovement->debit=0;
        $accountMovement->credit=$request->quantity;
        $accountMovement->date=Carbon::now();
        $accountMovement->currency = $request->currency;
        $accountMovement->currency_rate = ($request->rate ?? Swap::latest($profile->currency . '/' . $request->currency)->getValue()) ?? 1;
        $accountMovement->save();
      }
      else if($request->category==2){
        $accountMovement= new AccountMovement();
        $accountMovement->account_id=$request->account_id;
        $accountMovement->location_id=$request->fromLocationid;
        $accountMovement->debit=$request->quantity;
        $accountMovement->credit=0;
        $accountMovement->date=Carbon::now();
        $accountMovement->currency = $request->currency;
        $accountMovement->currency_rate = ($request->rate ?? Swap::latest($profile->currency . '/' . $request->currency)->getValue()) ?? 1;
        $accountMovement->save();
      }
      else {
        $accountMovement= new AccountMovement();
        $accountMovement->account_id=$request->account_id;
        $accountMovement->location_id=$request->fromLocationid;
        $accountMovement->debit=0;
        $accountMovement->credit=$request->quantity;
        $accountMovement->date=Carbon::now();
        $accountMovement->currency = $request->currency;
        $accountMovement->currency_rate = ($request->rate ?? Swap::latest($profile->currency . '/' . $request->currency)->getValue()) ?? 1;
        $accountMovement->save();
      }
      return response()->json(200,200);
    }
  }
