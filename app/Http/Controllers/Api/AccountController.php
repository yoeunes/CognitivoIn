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
  public function index(Profile $profile)
  {
      return response()->json(Account::where('profile_id',$profile->id)->select('id','name')->get());
  }

  public function search(Profile $profile, $query)
  {
      $accounts = null;

      if (strlen($query) >= 3)
      {
        $accounts = Account::where(function ($q) use ($query)
          {
              $q->where('name', 'LIKE', '%' . $query . '%')
              ->orWhere('number', 'LIKE', '%' . $query . '%');
          })
        ->where('profile_id', $profile->id)
        ->get();



      }

      return response()->json($accounts);
  }

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

  public function convert_date($date)
  {
    return Carbon::createFromFormat('Y-m-d H:i:s', $date);
  }
  public function sync(Request $request, Profile $profile)
  {
    $this->upload($request, $profile);
    $data=$this->download($request, $profile);
    return response()->json($data,200);
  }

  public function Upload(Request $request,Profile $profile)
  {
    $data = collect();

    if ($request->all() != [])
    {
      $data = collect($request->all());
    }

    $collection = json_decode($data->toJson());

    foreach ($collection as $key => $data)
    {
      $account = Account::where('slug',$data->CloudId)->first() ?? new Profile();
      if ($account->updated_at < $this->convert_date($data->updatedAt))
      {

        $account = new Account();
        $account->profile_id = $profile->id;
        $account->name = "Cash Account for " . $data->name;
        $account->number = "...";
        $account->currency = $profile->currency;
        $account->save();

      }

    }
    return response()->json('sucess',200);
  }

  public function Download(Request $request,Profile $profile)
  {
    return APIAccount::collection(Account::get());

  }
}
