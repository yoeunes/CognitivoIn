<?php

namespace App\Http\Controllers;

use App\Scheduals;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Profile;
use App\Relationship;
use App\AccountMovement;
use App\Currency;
use DB;

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

    $data=$request[0];

    if ($data['Type']==1) {
      $relationship=Relationship::GetCustomers()
      ->where('customer_alias',$data['PartnerName'])
      ->orWhere('customer_taxid',$data['PartnerTaxID'])->first();

    }
    else {
      $relationship=Relationship::GetSuppliers()
      ->where('supplier_alias',$data['PartnerName'])
      ->orWhere('supplier_taxid',$data['PartnerTaxID'])->first();
    }

    $schedules=Scheduals::where('relationship_id',$relationship->id)
    ->join('currencies', 'currencies.id', 'scheduals.currency_id')
    ->leftjoin('account_movements', 'scheduals.id', 'account_movements.schedual_id')
    ->groupBy('scheduals.currency_id')
    ->select(DB::raw('max(currencies.code) as code'),
    DB::raw('sum(scheduals.debit) as value'),
    DB::raw('max(scheduals.debit) as max_value'),
    DB::raw('max(scheduals.id) as InvoiceNumber'),
    DB::raw('max(scheduals.date) as InvoiceDate'),
    DB::raw('max(scheduals.date_exp) as Deadline'),
    DB::raw('max(scheduals.reference) as Reference')
    )->get();


    $data2 = [];
    $values = [];
    for ($i=0; $i <count($schedules) ; $i++)
    {
      $values[$i] = [
        'CurrencyCode' => $schedules[$i]->code ,
        'Value' => $schedules[$i]->value ,
        'MaxValue' => $schedules[$i]->max_value,
        'ReferenceCode' => $schedules[$i]->reference,
        'InvoiceNumber' => $schedules[$i]->InvoiceNumber,
        'InvoiceDate' => $schedules[$i]->InvoiceDate,
        'Deadline' => $schedules[$i]->Deadline,
      ];
    }

    $data2[] = [
      'ReferenceName' => $data['PartnerName'],
      'ReferenceTaxID' => $data['PartnerTaxID'],
      'Details' => $values ];


      return response()->json($data2,'200');

    }
    public function ReceivePayment(Request $request,Profile $profile)
    {



      $data=$request[0];
      if (!isset($data)) {
        $data=$request;
      }

      if ($data['Type']==1) {
        $relationship=Relationship::GetCustomers()
        ->where('customer_alias',$data['PartnerName'])
        ->orWhere('customer_taxid',$data['PartnerTaxID'])->first();

      }
      else {
        $relationship=Relationship::GetSuppliers()
        ->where('supplier_alias',$data['PartnerName'])
        ->orWhere('supplier_taxid',$data['PartnerTaxID'])->first();
      }


      $accountmovement=new AccountMovement();
      $accountmovement->schedual_id=$data['InvoiceReference'];
      $accountmovement->user_id=$relationship->id;
      $accountmovement->account_id=$data['AccountID'];
      $accountmovement->type_id=$data['Type'];
      $currency=Currency::where('code',$data['CurrencyCode'])
      ->orderBy('created_at', 'desc')->first();
      $accountmovement->currency_id=$currency->id;
      $accountmovement->currency_rate=$currency->exchange_rate;
      $accountmovement->date=Carbon::now();
      if ($data['Type']==1)
      {
        $accountmovement->credit=$data['Value'];
        $accountmovement->debit=0;
      }
      else
      {
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
