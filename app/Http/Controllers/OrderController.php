<?php

namespace App\Http\Controllers;


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

use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(Profile $profile,$skip)
    {
        $orders = Order::with('relationship')
        ->with('details')
        ->skip($skip)
        ->take(100)
        ->get();

        return response()->json($orders);
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create(Profile $profile)
    {

    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request,Profile $profile)
    {

        if (count($request->details)>0)
        {
            $order = Order::where('id', $request->id)->first() ?? new Order();

            $order->relationship_id = $request->relationship_id;
            $order->currency = 'PYG';
            $order->currency_rate = 1;
            $order->is_impex = 0;
            $order->is_printed = 0;
            $order->is_archived = 0;

            $order->save();

            foreach ($request->details as $detail)
            {
                $orderDetail = OrderDetail::where('id', $detail['id'])->first() ?? new OrderDetail();
                $orderDetail->order_id = $order->id;
                $orderDetail->item_id = $detail['item_id'];
                $orderDetail->item_name = $detail['sku'];
                $orderDetail->item_name = $detail['name'];
                $orderDetail->quantity = $detail['quantity'];
                $orderDetail->unit_price = $detail['price'];

                $orderDetail->save();

                return response()->json('success', 200);
            }
        }

        return response()->json('fail', 500);
    }

    /**
    * Display the specified resource.
    *
    * @param  \App\Order  $order
    * @return \Illuminate\Http\Response
    */
    public function show(Profile $profile,Order $order)
    {
        return response()->json($order->with('details')->first());
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Order  $order
    * @return \Illuminate\Http\Response
    */
    public function edit(Profile $profile,Order $order)
    {
        return response()->json(Order::with('details')->where('orders.id',$order->id)->first());
    }

    //Specifally used only for when changes occur to orders that are already approved.
    public function update(Request $request, Order $order)
    {
        //
    }

    public function destroy(Order $order)
    {
        //
    }

    public function approveNew(Profile $profile, Order $order)
    {

    }

    public function approve(Request $request, Profile $profile)
    {
        //return response()->json($request,'500');
        //Store payment information recieved by client application
        $data = $request[0];
        if (isset($data) == false)
        {
            $data = $request;
        }

        if ($data['Type'] == 1)
        {
            $relationship = Relationship::GetCustomers()
            ->where('customer_alias',$data['PartnerName'])
            ->orWhere('customer_taxid',$data['PartnerTaxID'])->first();

        }
        else
        {
            $relationship = Relationship::GetSuppliers()
            ->where('supplier_alias', $data['PartnerName'])
            ->orWhere('supplier_taxid', $data['PartnerTaxID'])->first();
        }

        $order = new Order();

        $order->number = $data['number'];
        $order->relationship_id = $relationship->id;
        $order->code = $data['range_code'];

        if ($data['contract_id']>0) {
            $order->contract_id = $data['contract_id'];
        }

        $order->code_expiry = Carbon::parse($data['code_expiry']);
        $order->is_printed = $data['number'] != "" ? true : false;
        $order->date = Carbon::now();
        $order->currency = 'PYG';
        $order->currency_rate = 1;
        $order->save();

        foreach ($data['Selectditems'] as $data_detail)
        {
            $item = Item::where('id', $data_detail['id'])->first();
            $vatdetail = VatDetail::where('vat_id', $item->vat_id)->get();

            $values = [];
            $item_value = $data_detail['sub_total_vat'];
            $vatamount= $data_detail['vatamount'];
            $i = 0;

            foreach ($vatdetail as $detail)
            {
                $vat = 0;
                if ($vatamount > 0 )
                {
                    $vat = (((($item_value) / (1 + $detail->coefficient)) - $item_value) * (-1)) * $detail->percent;
                }

                $values[$i] = [
                    'coefficient' => ($detail->coefficient * 100) . "%" ,
                    'Value' => number_format($vat, 0, ',', '.'),
                ];

                $i = $i + 1;
            }

            $detail = new OrderDetail();
            $detail->order_id = $order->id;
            $detail->item_id = $data_detail['id'];
            $detail->item_name = $data_detail['name'];
            $detail->quantity = number_format($data_detail['quantity'], 0, ',', '.');
            $detail->vat_id = $item->vat_id;
            $detail->unit_price = number_format($data_detail['unit_price'], 0, ',', '.');
            $detail->save();

            if ($item->is_stockable)
            {

                $movement = new ItemMovement();
                $movement->item_id = $data_detail['id'];
                $movement->location_id = $data_detail['location_id'];
                $movement->date = Carbon::now();

                if ($data['Type'] == 1)
                {
                    $movement->credit = 0;
                    $movement->debit = number_format($data_detail['quantity'], 0, ',', '.');;
                }
                else
                {
                    $movement->credit = number_format($data_detail['quantity'], 0, ',', '.');;
                    $movement->debit = 0;
                }

                $movement->save();
            }
        }

        if ($data['contract_id'] >0 )
        {
            $contract_details = ContractDetail::where('contract_id',$data['contract_id'])->get();
            foreach ($contract_details as $contract_detail )
            {
                $this->Generateschedual($relationship->id,
                $data['total_amount'] * $contract_detail->percent,
                Carbon::now()->addDays($contract_detail->offset),$data['Type']);
            }
        }
        else
        {
            $this->Generateschedual($relationship->id,
            $data['total_amount'],
            Carbon::now(),$data['Type']);
        }

        $account = Account::where('number', 1)->first() ?? new Account();
        $account->profile_id = $profile->id;
        $account->name = "Cash A/C Of " . $profile->name;
        $account->number = "1";
        $account->currency ='PYG';
        $account->save();

        $schedules = DB::select('
        select
        scheduals.currency as code, (scheduals.debit-(select if(sum(credit) is null,0,sum(credit)) from account_movements where `account_movements`.`status` != 3
        and `scheduals`.`id` = `account_movements`.`schedual_id`)) as value,
        scheduals.id , scheduals.date as InvoiceDate, scheduals.date_exp as Deadline,
        scheduals.reference as Reference from `scheduals`
        where `relationship_id` = '. $relationship ->id . ' and `scheduals`.`deleted_at` is null and (scheduals.debit-(select if(sum(credit) is null,0,sum(credit)) from account_movements where `account_movements`.`status` != 3
        and `scheduals`.`id` = `account_movements`.`schedual_id`)) >0  order by scheduals.date_exp');

        $schedules = collect($schedules);
        $remainvalue = $data['Value'];

        for ($i = 0; $i < count($schedules) ; $i++)
        {
            if ($remainvalue>0)
            {

                $accountmovement = new AccountMovement();
                $accountmovement->schedual_id = $schedules[$i]->id;
                $accountmovement->account_id = $account->id;
                $accountmovement->type = $data['Type'];
                $accountmovement->currency = 'PYG';
                $accountmovement->currency_rate = 1;
                $accountmovement->date = Carbon::now();

                if ($schedules[$i]->value > $remainvalue)
                {
                    $value = $remainvalue;
                    $remainvalue = 0;
                }
                else {
                    $value = $schedules[$i]->value;
                    $remainvalue = $remainvalue - $schedules[$i]->value;
                }
                if ($data['Type'] == 1)
                {
                    $accountmovement->credit = $value;
                    $accountmovement->debit = 0;
                }
                else
                {
                    $accountmovement->credit = 0;
                    $accountmovement->debit = $value;
                }
                $accountmovement->save();
            }
        }

        $data2 = [];
        $data2[] = [
            'Date' => $order->date->format('d-m-Y'),
            'PaymentReference' => $accountmovement->id,
            'ResponseType' => 1,
            'Detail'=> $values
        ];

        return response()->json($data2, '200');
    }

    public function Generateschedual($relationship_id, $amount, $exp_date, $type)
    {
        $schedual = new Scheduals();
        $schedual->relationship_id = $relationship_id;
        $schedual->currency = 'PYG';
        $schedual->currency_rate = 1;
        $schedual->date = Carbon::now();
        $schedual->date_exp = $exp_date ;

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
}
