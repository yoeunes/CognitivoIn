<?php

namespace App\Http\Controllers;


use App\Order;
use App\OrderDetail;
use App\Profile;
use App\Relationship;

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

    $orders = Order::with('relationship')->with('details')->skip($skip)
    ->take(100)->get();

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

      //$currency=Currency::where('id',$request->details[0]['currency_id'])->first();


      $order = Order::where('id', $request->id)->first() ?? new Order();


      $order->relationship_id=$request->relationship_id;
      $order->currency='PYG';
      $order->currency_rate=1;
      $order->is_impex=0;
      $order->is_printed=0;
      $order->is_archived=0;

      $order->save();



      foreach ($request->details as $detail) {
        $orderDetail = OrderDetail::where('id', $detail['id'])->first()
        ?? new OrderDetail();
        $orderDetail->order_id= $order->id;
        $orderDetail->item_id= $detail['item_id'];
        $orderDetail->item_name= $detail['sku'];
        $orderDetail->item_name= $detail['name'];
        $orderDetail->quantity= $detail['quantity'];
        $orderDetail->unit_price= $detail['price'];

        $orderDetail->save();



        return response()->json('success');
      }

    }

    return response()->json('fail',500);
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

  /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  \App\Order  $order
  * @return \Illuminate\Http\Response
  */
  public function update(Request $request, Order $order)
  {
    //
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  \App\Order  $order
  * @return \Illuminate\Http\Response
  */
  public function destroy(Order $order)
  {
    //
  }
}
