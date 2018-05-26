<?php

namespace App\Http\Controllers\Api;

use App\Item;
use App\VatDetail;
use App\Relationship;
use App\Profile;
use App\Account;
use App\AccountMovement;
use App\Scheduals;
use App\Order;
use App\OrderDetail;
use App\Contract;
use App\ContractDetail;
use App\ItemMovement;
use Carbon\Carbon;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AccountController extends Controller
{

  public function list_account_receivables(Profile $profile, $customer_ID)
  {
    $customers = Scheduals::join('relationships','relationships.id','=','scheduals.relationship_id')
    ->where('relationships.customer_id', $customer_ID)
    ->get();

    return response()->json($customers);
  }

  public function list_account_payables(Profile $profile, $supplier_ID)
  {
    $suppliers = Scheduals::join('relationships','relationships.id','=','scheduals.relationship_id')
    ->where('relationships.supplier_id', $supplier_ID)
    ->get();

    return response()->json($suppliers);
  }




  public function get_CustomerSchedual(Request $request, Profile $profile)

  {

    //return payment schedual. history of unpaid debt. by Customer TaxID
    if ($request->Type==1) {
      $relationship = Relationship::GetCustomers()
      ->where('customer_alias',$request->PartnerName)
      ->orWhere('customer_taxid',$request->PartnerTaxID)->first();

    }
    else {
      $relationship = Relationship::GetSuppliers()
      ->where('supplier_alias',$request->PartnerName)
      ->orWhere('supplier_taxid',$request->PartnerTaxID)->first();
    }

    $schedules = Scheduals::where('relationship_id', $relationship->id)
    ->leftjoin('account_movements', 'scheduals.id', 'account_movements.schedual_id')
    ->select(DB::raw('max(scheduals.currency) as code'),
    DB::raw('max(scheduals.credit)-sum(account_movements.debit) as value'),
    DB::raw('max(scheduals.id) as InvoiceNumber'),
    DB::raw('max(scheduals.date) as InvoiceDate'),
    DB::raw('max(scheduals.date_exp) as Deadline'),
    DB::raw('max(scheduals.reference) as Reference'))
    ->groupBy('account_movements.schedual_id')
    ->get();

    $return = [];
    $values = [];

    for ($i = 0; $i < count($schedules) ; $i++)
    {
      $values[$i] = [
        'CurrencyCode' => $schedules[$i]->code ,
        'Value' => $schedules[$i]->value ,
        'ReferenceCode' => $schedules[$i]->reference,
        'InvoiceNumber' => $schedules[$i]->InvoiceNumber,
        'InvoiceDate' => $schedules[$i]->InvoiceDate,
        'Deadline' => $schedules[$i]->Deadline,
      ];
    }

    //for each currency requested, run loop and add into array

    $return[] = [

      'ReferenceName' => $request->PartnerName,
      'ReferenceTaxID' => $request->PartnerTaxID,
      'Details' => $values
    ];

    return response()->json($return, '200');
  }


  public function Generateschedual($relationship_id,$amount,$exp_date,$type)
  {
    $schedual = new Scheduals();
    $schedual->relationship_id = $relationship_id;
    $schedual->currency = 'PYG';
    $schedual->currency_rate = 1;
    $schedual->date = Carbon::now();
    $schedual->date_exp =$exp_date ;

    if ($type == 1)
    {
      $schedual->credit = 0;
      $schedual->debit =$amount ;
    }
    else
    {
      $schedual->credit = $amount;
      $schedual->debit = 0;
    }

    $schedual->save();
  }
  public function AmountFromContract(Request $request, Profile $profile)
  {

    $data = $request;

    if ($data['contract_id'] >0 )
    {
      $contract_details=ContractDetail::where('contract_id',$data['contract_id'])->orderBy('offset')->first();
      return response()->json($data['total_amount'] * $contract_details->percent, '200');
    }
    return response()->json($data['total_amount'] , '200');
  }
}
