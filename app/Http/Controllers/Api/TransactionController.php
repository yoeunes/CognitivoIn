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

    //upload indivdual and bulk invoice
    // TODO: Make chunks of data. learn from debehaber
    public function upload(Request $request, Profile $profile)
    {
        $returnData = [];
        $pos=0;
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


            $order=$orderController->store($request->replace([$data]), $profile);
            $data->cloud_id=$order->id;
            //A.3.1) Approve or Annull? Update Status (For not do not run aditional code)
            if ($data->cloud_id > 0 && $data->status == 2)
            {
                $orderController->approve($data->cloud_id);
            }
            else if($data->cloud_id > 0 && $data->status == 3)
            {
                $orderController->annull($data->cloud_id);
            }
            $returnData[$pos]=$order;
            $pos=$pos+1;
            //A.3.2) Run promotion if approved
        }

        //TODO return values with created cloud_id back to client.

        //Wrong, do not send same collection again. no help to developer
        return response()->json($returnData);
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
