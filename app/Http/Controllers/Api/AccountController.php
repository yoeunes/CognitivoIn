<?php

namespace App\Http\Controllers\Api;

use App\Item;
use App\Relationship;
use App\Profile;
use App\Account;
use App\AccountMovement;
use App\Scheduals;
use App\Order;
use App\OrderDetail;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AccountController extends Controller
{

    public function list_account_receivables(Profile $profile,$customer_ID)
    {
        $suppliers = Scheduals::join('relationships','relationships.id','=','scheduals.relationship_id')
        ->where('relationships.customer_id',$customer_ID)
        ->get();

        return response()->json($suppliers);
    }

    public function list_account_payables(Profile $profile,$supplier_ID)
    {
        $suppliers = Scheduals::join('relationships','relationships.id','=','scheduals.relationship_id')
        ->where('relationships.supplier_id',$supplier_ID)
        ->get();

        return response()->json($suppliers);
    }




    public function get_CustomerSchedual(Request $request, Profile $profile)
    {
        //return payment schedual. history of unpaid debt. by Customer TaxID
        $data = $request[0];

        if ($data['Type']==1) {
            $relationship=Relationship::GetCustomers()
            ->where('customer_alias',$data['PartnerName'])
            ->first();

        }
        else {
            $relationship=Relationship::GetSuppliers()
            ->where('supplier_alias',$data['PartnerName'])
            ->orWhere('supplier_taxid',$data['PartnerTaxID'])->first();
        }

        $schedules = Scheduals::where('relationship_id', $relationship->id)
        ->leftjoin('account_movements', 'scheduals.id', 'account_movements.schedual_id')
        ->select(DB::raw('max(currency) as code'),
        DB::raw('max(scheduals.debit)-sum(account_movements.credit) as value'),
        DB::raw('max(scheduals.id) as InvoiceNumber'),
        DB::raw('max(scheduals.date) as InvoiceDate'),
        DB::raw('max(scheduals.date_exp) as Deadline'),
        DB::raw('max(scheduals.reference) as Reference'))
        ->groupBy('account_movements.schedual_id')
        ->get();

        $data2 = [];
        $values = [];

        for ($i = 0; $i <count($schedules) ; $i++)
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

        $data2[] = [
            'ReferenceName' => $data['PartnerName'],
            'ReferenceTaxID' => $data['PartnerTaxID'],
            'Details' => $values ];

            return response()->json($data2, '200');
        }

        public function ApproveSales(Request $request, Profile $profile)
        {
            //return response()->json($request,'500');
            //Store payment information recieved by client application
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

            $order=new Order();

            $order->number = $data['number'];
            $order->relationship_id=$relationship->id;
            $order->code = $data['code'];
            //$order->code_expiry = $data['code_expiry'];
            $order->is_printed = $data['number'] != "" ? true : false;
            $order->date =Carbon::now();
            $order->currency = 'PRY';
            $order->currency_rate = 1;
            $order->save();

            foreach ($data['Selectditems'] as $data_detail)
            {
                $detail = new OrderDetail();
                $detail->order_id = $order->id;
                $detail->item_id = $data_detail['id'];
                $detail->item_name = $data_detail['name'];
                $detail->quantity = $data_detail['quantity'];
                $detail->unit_price = $data_detail['unit_price'];
                $detail->save();

            }

            $schedual= new Scheduals();
            $schedual->relationship_id = $relationship->id;
            $schedual->currency = 'PRY';
            $schedual->currency_rate = 1;
            $schedual->date = Carbon::now();
            $schedual->date_exp = Carbon::now();

            if ($data['Type']==1)
            {
                $schedual->credit = $data['total_amount'];
                $schedual->debit = 0;
            }
            else
            {
                $schedual->credit = 0;
                $schedual->debit = $data['total_amount'];
            }

            $schedual->save();

            $account = Account::where('number',1)->first()==null?new Account():
            Account::where('number',1)->first();
            $account->name = "Cash A/c Of " . $profile->name;
            $account->number = "1";
            $account->currency ='PRY';
            $account->save();

            $accountmovement = new AccountMovement();
            $accountmovement->schedual_id = $schedual->id;
            $accountmovement->user_id = $relationship->id;
            $accountmovement->account_id = $account->id;
            $accountmovement->type_id = $data['Type'];
            $accountmovement->currency = 'PRY';
            $accountmovement->currency_rate = 1;
            $accountmovement->date = Carbon::now();

            if ($data['Type'] == 1)
            {
                $accountmovement->credit = $data['Value'];
                $accountmovement->debit = 0;
            }
            else
            {
                $accountmovement->credit = 0;
                $accountmovement->debit = $data['Value'];
            }
            $accountmovement->save();

            $data2 = [];

            $data2[] = [
                'PaymentReference' => $accountmovement->id,
                'ResponseType' => 1
            ];
            return response()->json($data2, '200');
        }

        public function annullPayment(Request $request, Profile $profile)
        {
            //in request, take paymentID given by previous payment to annull value
        }
    }
