<?php

namespace App\Http\Controllers;

use App\Scheduals;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Profile;
use App\Relationship;

class SchedualsController extends Controller
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
  * @param  \App\Scheduals  $scheduals
  * @return \Illuminate\Http\Response
  */
  public function show(Scheduals $scheduals)
  {
    //
  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  \App\Scheduals  $scheduals
  * @return \Illuminate\Http\Response
  */
  public function edit(Scheduals $scheduals)
  {
    //
  }

  /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  \App\Scheduals  $scheduals
  * @return \Illuminate\Http\Response
  */
  public function update(Request $request, Scheduals $scheduals)
  {
    //
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  \App\Scheduals  $scheduals
  * @return \Illuminate\Http\Response
  */
  public function destroy(Scheduals $scheduals)
  {
    //
  }


  public function PaymentDue(Request $request,Profile $profile)
  {
    if (data['Type']==1) {
      $relationship=Relationship::GetCustomers()
      ->where('customer_alias',data['PartnerName'])
      ->orWhere('customer_taxid',data['PartnerTaxID'])->first();

      $schedule=Scheduals::where('relationship_id',$relationship->id)
      ->join('currencies', 'currencies.id', 'scheduals.currency_id')
      ->join('account_movements', 'scheduals.id', 'account_movements.schedual_id')
      ->groupBy('scheduals.currency_id')
      ->select(DB::raw('max(currencies.code) as code'),
      DB::raw('sum(scheduals.debit) as value'),
      DB::raw('max(scheduals.debit) as maxvalue'),
      DB::raw('max(scheduals.id) as InvoiceNumber'),
      DB::raw('max(scheduals.date) as InvoiceDate'),
      DB::raw('max(scheduals.date_exp) as Deadline')
    );
    
  }
  else {
    $relationship=Relationship::GetSupplier()
    ->where('supplier_alias',data['PartnerName'])
    ->orWhere('supplier_taxid',data['PartnerTaxID'])->first();

    $schedule=Scheduals::where('relationship_id',$relationship->id)
    ->join('currencies', 'currencies.id', 'scheduals.currency_id')
    ->join('account_movements', 'scheduals.id', 'account_movements.schedual_id')
    ->groupBy('scheduals.currency_id')
    ->select(DB::raw('max(currencies.code) as code'),
    DB::raw('sum(scheduals.credit) as value'),
    DB::raw('max(scheduals.credit) as maxvalue'),
    DB::raw('max(scheduals.id) as InvoiceNumber'),
    DB::raw('max(scheduals.date) as InvoiceDate'),
    DB::raw('max(scheduals.date_exp) as Deadline')
  );
  }


  $data2 = [];
  $values = [];
  $values[0] = [
    'CurrencyCode' => 'PYG' , 'Value' => 4567 ,'MaxValue' => 12589];
    $values[1] = [
      'CurrencyCode' => 'USD' , 'Value' => 895 ,'MaxValue' => 5800];
      $data2[] = [
        'ReferenceName' => 'ABC',
        'ReferenceTaxID' => '145-567-8545428',
        'Details' => [
          'ReferenceCode' => '1'
          ,'InvoiceNumber' => '5'
          ,'InvoiceDate' => '2018/12/05'
          ,'Deadline' => '2018/12/25'
          ,'Values' =>$values
          ]];


          return response()->json($data2,'200');

        }
        public function ReceivePayment(Request $request,Profile $profile)
        {


          $data=$request;


          $accountmovement=new AccountMovement();
          $accountmovement->schedula_id=$data['InvoiceReference'];
          $accountmovement->user_id=$profile->id;
          $accountmovement->account_id=$data['AccountID'];
          $accountmovement->type_id=$data['Type'];
          $currency=Curency::where('code',$data['CurrencyCode'])
          ->orderBy('created_at', 'desc')->first();
          $accountmovement->currency_id=$currency->id;
          $accountmovement->currency_rate=$currency->exchange_rate;
          $accountmovement->date=Carbon::now();
          if ($data['Type']==1) {
            $accountmovement->credit=$data['Value'];
            $accountmovement->debit=0;
          }
          else {
            $accountmovement->credit=0;
            $accountmovement->debit=$data['Value'];
          }
          $accountmovement->save();

          $data2 = [];

          $data2[] = [
            'PaymentReference' => $accountmovement->id,
            'ResponseType' => 1
          ];
          return response()->json($data2,'200');
        }
      }
