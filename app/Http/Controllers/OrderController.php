<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderDetail;
use App\OrderStatus;
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
    public function index(Profile $profile)
    {

        $orders = Order::FromCustomers()->orderBy('trans_date')->paginate(50);

        return view('company.sales.orders.list')->with('orders', $orders);
    }
    public function list_orders(Profile $profile,$skip)
    {

      $orders = Order::with('details')->skip($skip)
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
        $customers=Relationship::GetCustomers()->get();
        return view('company.sales.orders.form')->with('customers',$customers);
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

            $currency=Currency::where('id',$request->details[0]['currency_id'])->first();

            if (isset($currency)) {

                $order= new Order();

                $order->relationship_id=$request->relationship_id;
                $order->currency_id=$currency->id;
                $order->currency_rate=$currency->exchange_rate;
                $order->status=1;
                $order->is_impex=0;
                $order->is_printed=0;
                $order->is_archived=0;

                $order->save();

                $orderstatus = new OrderStatus();
                $orderstatus->order_id = $order->id;
                $orderstatus->status = 1;
                $orderstatus->save();


                foreach ($request->details as $detail) {

                    $orderDetail= new OrderDetail();
                    $orderDetail->order_id= $order->id;
                    $orderDetail->item_id= $detail['item_id'];
                    $orderDetail->quantity= $detail['quantity'];
                    $orderDetail->unit_price= $detail['price'];

                    $orderDetail->save();
                }


                return response()->json('success');
            }

        }

        return response()->json('fail');
    }

    /**
    * Display the specified resource.
    *
    * @param  \App\Order  $order
    * @return \Illuminate\Http\Response
    */
    public function show(Profile $profile,Order $order)
    {

        return view('company.sales.orders.show')->with('order', $order->with('details')->first());
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Order  $order
    * @return \Illuminate\Http\Response
    */
    public function edit(Profile $profile,$id)
    {

        $order=Order::where('id',$id)->with('details')->get();
        return response()->json($order);
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
