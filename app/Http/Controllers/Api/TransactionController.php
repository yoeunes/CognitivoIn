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
use App\Http\Resources\APITransaction;
use App\Http\Controllers\Controller;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AccountMovementController;
use Illuminate\Http\Request;
use DB;
use Swap\Laravel\Facades\Swap;

class TransactionController extends Controller
{
  public function sync(Request $request, Profile $profile)
  {
    $data=$this->upload($request, $profile);

    return response()->json($data->original,200);
  }
  //upload indivdual and bulk invoice
  // TODO: Make chunks of data. learn from debehaber
  public function upload(Request $request, Profile $profile)
  {

    $salesData = array();
    $data = collect();

    if ($request->all() != [])
    {
      $data = collect($request->all());
    }

    $collection = json_decode($data->toJson());
  $i=0;
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

      // if (count($data->details) > 0)
      // {
      //
      //     return response()->json($data->details, 500);
      //     $order = Order::mySales()
      //     ->where('id', $data->cloud_id)
      //     ->with('details')
      //     ->first()
      //     ??
      //     new Order();
      //
      //     if ($data->relationship_cloud_id>0)
      //     {
      //         $order->relationship_id = $data->relationship_cloud_id;
      //     }
      //     else
      //     {
      //         $CustomerController = new Api\CustomerController();
      //         $order->relationship_id = $CustomerController->CreateCustomer($data->customer, $profile)->id;
      //     }
      //
      //     //$order->relationship_id = $data->relationship_cloud_id;
      //     $order->currency = $data->currency ?? $profile->currency;
      //     $order->currency_rate = ($data->rate ?? Swap::latest($profile->currency . '/' . $data->currency)->getValue()) ?? 1;
      //     $order->is_impex = $data->is_impex ?? 0;
      //     $order->is_printed = $data->is_printed ?? 0;
      //     $order->is_archived = $data->is_archived ?? 0;
      //
      //     $order->save();
      //
      //     foreach ($detail as $detail)
      //     {
      //
      //         $orderDetail = $order->details->where('id', $detail->detail_cloud_id)->first() ?? new OrderDetail();
      //         $orderDetail->order_id = $order->id;
      //
      //         if ($detail->item_cloud_id > 0)
      //         {
      //             $orderDetail->item_id = $detail->item_cloud_id;
      //             $orderDetail->item_sku = $detail->sku;
      //             $orderDetail->item_name = $detail->name;
      //         }
      //         else
      //         {
      //             $ItemController = new Api\ItemController();
      //             $item = $ItemController->CreateItem($detail->item, $profile);
      //             $orderDetail->item_id = $item->id;
      //             $orderDetail->item_sku = $item->code;
      //             $orderDetail->item_name = $item->name;
      //         }
      //
      //
      //         $orderDetail->quantity = $detail->quantity;
      //         $orderDetail->unit_price = $detail->price;
      //
      //         $orderDetail->save();
      //     }
      //
      //
      //
      //     $data->cloud_id=$order->id;
      //     return response()->json($data,500);
      // }
      //A.3.1) Approve or Annull? Update Status (For not do not run aditional code)
      if ($data->cloud_id > 0 && $data->status == 2)
      {
        $orderController->approve($profile,$data->cloud_id);
      }
      else if($data->cloud_id > 0 && $data->status == 3)
      {
        $orderController->annul($profile,$data->cloud_id);
      }

      //A.3.2) Run promotion if approved
      $salesData[$i] = $order->id;
      $i=$i+1;
    }

    //TODO return values with created cloud_id back to client.
    $salesData=APITransaction::collection(
      Order::whereIn('id',$salesData)
      ->with('details')
      ->get());
    //Wrong, do not send same collection again. no help to developer
    return response()->json($salesData,200);
  }

  public function download(Request $request, Profile $profile)
  {
    return APITransaction::collection(
      Order::mySales()
      ->with('details')
      ->get());

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
