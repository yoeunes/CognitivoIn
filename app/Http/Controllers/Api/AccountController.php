<?php

namespace App\Http\Controllers\Api;

use App\Item;
use App\Relationship;
use App\Profile;
use App\AccountMovement;
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

        public function recievePayment(Request $request, Profile $profile)
        {

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

            $schedual= new Scheduals();
            $schedual->relationship_id=$relationship->id;
            $schedual->currency='PRY';
            $schedual->currency_rate=1;
            $schedual->date=Carbon::now();
            $schedual->date_exp=Carbon::now();
            if ($data['Type']==1)
            {
                $schedual->credit=$data['total_amount'];
                $schedual->debit=0;
            }
            else
            {
                $schedual->credit=0;
                $schedual->debit=$data['total_amount'];
            }
            $schedual->save();

            $accountmovement=new AccountMovement();
            $accountmovement->schedual_id=$schedual->id;
            $accountmovement->user_id=$relationship->id;
            $accountmovement->account_id=$data['AccountID'];
            $accountmovement->type_id=$data['Type'];
            // $currency=Currency::where('code',$data['CurrencyCode'])
            // ->orderBy('created_at', 'desc')->first();
            $accountmovement->currency='PRY';
            $accountmovement->currency_rate=1;
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

        public function annullPayment(Request $request, Profile $profile)
        {
            //in request, take paymentID given by previous payment to annull value
        }
    }
