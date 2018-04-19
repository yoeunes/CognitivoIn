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
    // $data=$request[0];
    // if ($data['type']==1)
    // {
    //   $relationship =  Relationship::join('profiles', 'relationships.supplier_id', 'profiles.id')
    //   ->where('supplier_id', $profile)
    //   ->where('supplier_accepted', true)->Where('taxid', $data['ReferenceTaxID'])
    //   ->select('relationships.id')->first();
    // }
    // else
    // {
    //   $relationship =  Relationship::join('profiles', 'relationships.customer_id', 'profiles.id')
    //   ->where('customer_id', $profile)
    //   ->where('customer_accepted', true)->Where('taxid', $data['ReferenceTaxID'])
    //   ->select('relationships.id')->first();
    // }
    //
    // if (isset($relationship))
    // {
    //   $scheduals=Scheduals::join('relationships', 'Scheduals.relationship_id', 'relationships.id')
    //   ->join('currencies', 'Scheduals.currency_id', 'currencies.id')
    //   ->where('relationship_id',$relationship->id)
    //   ->whereIn('currencies.code',$data['Currencies'])
    //   ->groupBy('currencies.code')
    //   ->select(DB::raw('max(customer_alias) as customer_alias'),
    //   DB::raw('max(customer_taxid) as customer_taxid'),
    //   DB::raw('max(currencies.name) as currency'),
    //   DB::raw('max(currencies.rate) as rate'),
    //   DB::raw('max(date) as InvoiceDate'),
    //   DB::raw('max(date_exp) as Deadline'),
    //   DB::raw('sum(debit) as Debit'),
    //   DB::raw('sum(credit) as Debit'))
    //   ->get();


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
          public function ReceivePayment(Request $request,$profile)
          {
            return response()->json($request->data[0]->currency_id);
            $data=$request[0];
            $scheduals=new Scheduals();
            $scheduals->relationship_id=$data['relationship_id'];
            $scheduals->currency_id=$data['currency_id'];
            $scheduals->rate=$data['rate'];
            $scheduals->date=Carbon::now();
            $scheduals->date_exp=Carbon::now();
            $scheduals->debit=$data['total_amount'];
            $scheduals->save();

            $scheduals=new Scheduals();
            $scheduals->relationship_id=$data['relationship_id'];
            $scheduals->currency_id=$data['currency_id'];
            $scheduals->rate=$data['rate'];
            $scheduals->date=Carbon::now();
            $scheduals->date_exp=Carbon::now();
            $scheduals->credit=$data['"amount"'];
            $scheduals->save();




            $data2 = [];

            $data2[] = [
              'PaymentReference' => $scheduals->id,
              'ResponseType' => 1
            ];
            return response()->json($data2,'200');
          }
        }
