<?php

namespace App\Http\Controllers\Api;

use App\Item;
use App\Relationship;
use App\Profile;
use App\Order;
use App\Vat;
use App\VatDetail;
use App\OrderDetail;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AccountMovementController;
use Illuminate\Http\Request;
use DB;
use Swap\Laravel\Facades\Swap;

class TransactionController extends Controller
{
    // this is useful for app
    public function SalesInvoice_createApprove(Request $request,Profile $profile)
    {
        $data = $request[0];

        if (isset($data) == false)
        {
            $data = $request;
        }

        //Run Validations and prevent malitious users from inserting data that is not supposed to be entered.

        $order = new Order();

        $order->number = $data['number'];
        $order->relationship_id = $data['relationship_id'];
        $order->code = $data['range_code'];
        $order->location_id = $data['location_id'];

        if ($data['contract_id'] > 0)
        {
            $order->contract_id = $data['contract_id'];
        }

        $order->code_expiry =$data['code_expiry'] ? Carbon::parse($data['code_expiry']) : null;

        //TODO. wrong. let front end decide if it is printed or not.
        $order->is_printed = $data['isPrinted'] ?? false;
        $order->is_impex = $data['isImpex'] ?? false;

        $order->date = $data['date'] ?? Carbon::now();
        $order->currency = $data['currency'] ?? $profile->currency;
        $order->currency_rate = ($data['rate'] ?? Swap::latest($profile->currency . '/' . $order->currency)->getValue()) ?? 1;
        $order->save();

        foreach ($data['details'] as $data_detail)
        {
            $item = Item::where('id', $data_detail['id'])->select('id', 'vat_id')->first();
            $detail = new OrderDetail();
            $detail->order_id = $order->id;
            $detail->item_id = $item->id;

            $detail->item_sku = $data_detail['sku'];
            $detail->item_name = $data_detail['name'];
            $detail->quantity = (double)$data_detail['quantity'];
            $detail->vat_id = $item->vat_id;
            $detail->unit_price = (double)$data_detail['unit_price'];
            $detail->save();
        }

        $orderController = new OrderController();
        //insert movement and schedual.
        $orderController->approve($profile,$order->id);

        $accountMovement = new AccountMovementController();
        // payment of particular order
        $accountMovement->makePayment($request, $order->id);

        $vatDetail = VatDetail::leftjoin('order_details', 'order_details.vat_id', 'vat_details.vat_id')
        ->where('order_id', $order->id)
        ->select(DB::raw('CONCAT(round(max(coefficient),2) * 100, "%") as coefficient'),
        DB::raw('round(sum(percent * coefficient * unit_price * quantity), 2) as value')
        )
        ->groupBy('coefficient')
        ->get();

        $data2 = [];
        $data2[] = [
            'Date' => $order->date,
            'Detail'=> $vatDetail
        ];

        return response()->json($data2);
    }

    //TODO: This file requires the most amount of work.
    //This code is too complicated. Make it simple:
    //1) Upload (collection or individually). Return invoice cloud id (collection or individually)
    //2) Download. Return state of x id's or non-synced invoices.
    //3) Approve (collection or individually). Return Invoice (collection or individually)
    //4) Sync (Upload and Download code together)


    //upload indivdual and bulk invoice
    // TODO: Make chunks of data. learn from debehaber
    public function upload (Request $request, Profile $profile)
    {
        $data = collect();

        if ($request->all() != [])
        {
            $data = collect($request->all());
        }

        $collection = json_decode($data->toJson());

        foreach ($collection as $key => $data)
        {
            $orderController = new OrderController();
            //The store function will automatically check if order exists or not.
            //A) Check if Order Exists through CloudID
            //A.1.1) CloudID == null ? Save Order into table
            //A.1.2) Save Detail into table
            //A.2.1) CloudID != null ? Update Order
            //A.2.2) Update Detail
            $orderController->store($request, $profile);


            //A.3.1) Approve or Annull? Update Status (For not do not run aditional code)
            if ($data->cloud_id > 0 && $data->status == 2)
            {
                $orderController->approve($data->cloud_id);
            }
            else if($data->cloud_id && $data->status == 3)
            {
                $orderController->annull($data->cloud_id);
            }
            //A.3.2) Run promotion if approved

            //If Exists == false, create Order, link Relationship and use.
            // if(isset($order) == false)
            // {
            //     $order = new Order();
            //     $order->relationship_id = $this->checkCreateRelationships($profile, $data)->id;
            // }

            //fill up data regardless if exists or not. this will allow new data to prevail.
            // $data->customer->cloud_id = $order->relationship_id;
            // $this->loadData_Order($order, $data);
            //insert payment schedual if paymnet not done

            // $orderController = new OrderController();
            //insert movement and schedual
            //$orderController->stockEntry($order);

            //TODO> make new object with local_id + cloud_id and send back to user.
        }

        //Wrong, do not send same collection again. no help to developer
        //return response()->json($collection);
    }

    //This function will create or update an existing Order with the new data inserted.
    public function loadData_Order($order, $data)
    {
        $profile = request()->route('profile');
        $order->ref_id = $data->local_id;
        $order->number = $data->number;
        $order->is_printed = $data->number != "" ? true : false;
        $order->trans_date =$this->convert_date($data->trans_date);
        $order->credit_days = $data->credit_days;
        $branch = Location::where('profile_id', $profile->id)->where('name', $data->branch_name)->first();

        if (!isset($branch)) {
            $branch = new Location();
            $branch->profile_id = $profile->id;
            $branch->name = $data->branch_name;
            $branch->save();
        }

        $order->location_id = $branch->id;

        //$currency = Currency::first();
        $order->currency_id = $data->currency_code;
        $order->currency_rate = $data->currency_rate;
        $order->comment = $data->comment;

        $order->save();

        //assign id to collection.
        $data->ref_id = $order->id;

        //Is it possible to use $order instead of getting fresh data from db?
        //$order = Order::where('id', $order->id)->with('details')->first();

        foreach ($data->details as $detail)
        {
            $detail = $order->details->where('ref_id', $data->my_id)->first(); //OrderDetail::where('ref_id', $id_ref)->first();

            if(isset($detail) == false)
            {
                $detail = new OrderDetail();
                $detail->order_id = $order->id;
            }


            $detail->item_id = $this->checkCreateItems($profile, $data)->id;
            $detail->ref_id = $detail->local_id;
            $detail->quantity = $detail->quantity;
            $detail->unit_price = $detail->price;
            //$detail->discount = $data->discount;
            $detail->save();

            $detail->ref_id = $detail->id;
        }

    }

    public function download(Request $request, Profile $profile)
    {
        $orders = Order::FromCustomers()
        ->leftJoin('order_status','orders.id','=','order_status.order_id')
        ->with('details')
        ->whereNull('sync_date')
        ->get();
        return response()->json($orders);
    }

    public function approve(Request $request, Profile $profile)
    {
        //Check if user has premium plan to use approval

        $orderController = new OrderController();
        $orderController->approve($data->cloud_id);
    }

    public function annull(Request $request, Profile $profile)
    {
        //check if user has premium plan to annull

        $orderController = new OrderController();
        $orderController->annull($data->cloud_id);
    }
}
