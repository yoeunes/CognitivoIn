<?php

namespace App\Http\Controllers;


use App\Item;
use App\VatDetail;
use App\Relationship;
use App\Profile;
use App\Account;
use App\AccountMovement;
use App\Schedule;
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
    public function index(Profile $profile, $skip)
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
    public function store(Request $request, Profile $profile)
    {
        if (count($request->details) > 0)
        {
            $order = Order::where('id', $request->id)->first() ?? new Order();

            $order->relationship_id = $request->relationship_id;
            $order->currency = $request->currency ?? $profile->currency;
            $order->currency_rate = ($request->rate ?? Swap::latest($profile->currency . '/' . $request->currency)->getValue()) ?? 1;
            $order->is_impex = $request->is_impex ?? 0;
            $order->is_printed = $request->is_printed ?? 0;
            $order->is_archived = $request->is_archived ?? 0;

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
    public function show(Profile $profile, $orderID)
    {
        $order = Order::where('id', $orderID)
        ->with('details')
        // ->with('customer')
        ->first();

        return response()->json($order);
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Order  $order
    * @return \Illuminate\Http\Response
    */
    public function edit(Profile $profile,Order $order)
    {
        $order = Order::where('id', $order->id)->with('details')->first();
        return response()->json($order);
    }

    public function destroy(Order $order)
    {
        //
    }

    public function approve($orderID)
    {
        $order = Order::where('id', $orderID)->with('details')->first();
        $amount = 0;
        $vatAmount = 0;

        //for stock entry
        foreach ($order->details as  $detail)
        {
            $vatDetails = VatDetail::where('vat_id', $detail->vat_id)->get();

            foreach ($vatDetails as $vat)
            {
                $vatAmount = $vatAmount + (($detail->unit_price * $vat->percent) *  $vat->coefficient);
            }

            $amount = $amount + (($detail->unit_price + $vatAmount) * $detail->quantity);

            //TODO Get only required column. you are using one column only.
            $item = Item::find($detail->item_id);

            if ($item->is_stockable && $order->location_id != null)
            {
                $movement = new ItemMovement();
                $movement->item_id = $item->id;
                $movement->location_id = $order->location_id;
                $movement->date = Carbon::now();
                $movement->credit = 0;
                $movement->debit = $detail->quantity;
                $movement->save();
            }
        }

        //for payment entry
        if ($order->contract_id > 0)
        {
            $contractDetails = ContractDetail::where('contract_id', $order->contract_id)->get();
            $schedualAmount = 0;

            foreach ($contractDetails as $detail)
            {
                $schedule = new Schedule();
                $schedule->relationship_id = $order->relationship_id;
                $schedule->reference = $order->number;
                $schedule->currency = $order->currency;
                $schedule->currency_rate = $order->currency_rate;
                $schedule->date = Carbon::now();
                $schedule->due_date = Carbon::now()->addDays($detail->offset);
                $schedule->value = $amount * $detail->percent;
                $schedule->save();

                $schedualAmount += $schedule->credit;
            }

            if ($schedule->credit != $amount)
            {
                // add difference to last schedual on list.
            }
        }
        else
        {
            $schedule = new Schedule();
            $schedule->relationship_id = $order->relationship_id;
            $schedule->currency = $order->currency;
            $schedule->currency_rate = $order->currency_rate;
            $schedule->date = Carbon::now();
            $schedule->due_date = Carbon::now();
            $schedule->value = $amount;
            $schedule->save();
        }
    }

    //TODO make annull code for order.
    public function annul($orderID)
    {
        $order = Order::where('id', $orderID)->with('detail')->first();
        $amount = 0;
        $vatAmount = 0;

        //for stock entry
        foreach ($order->detail as  $detail)
        {
            //TODO Get only required column. you are using one column only.
            $item = Item::find($detail->item_id);

            if ($item->is_stockable && $order->location_id != null)
            {
                $movement = new ItemMovement();
                $movement->item_id = $item->id;
                $movement->location_id = $order->location_id;
                $movement->date = Carbon::now();
                $movement->credit = 0;
                $movement->debit = $detail->quantity;
                $movement->save();
            }
        }

        //for payment entry
        if ($order->contract_id > 0)
        {
            $contractDetails = ContractDetail::where('contract_id', $order->contract_id)->get();
            $schedualAmount = 0;

            foreach ($contractDetails as $detail)
            {
                $schedule = new Schedule();
                $schedule->relationship_id = $order->relationship_id;
                $schedule->currency = $order->currency;
                $schedule->currency_rate = $order->currency_rate;
                $schedule->date = Carbon::now();
                $schedule->date_exp = Carbon::now()->addDays($detail->offset);
                $schedule->credit = $amount * $detail->percent;
                $schedule->debit = 0;
                $schedule->save();

                $schedualAmount += $schedule->credit;
            }

            if ($schedule->credit != $amount)
            {
                // add difference to last schedual on list.
            }
        }
        else
        {
            $schedule = new Schedule();
            $schedule->relationship_id = $relationship_id;
            $schedule->currency = $order->currency;
            $schedule->currency_rate = $order->currency_rate;
            $schedule->date = Carbon::now();
            $schedule->date_exp = Carbon::now();
            $schedule->credit = $amount;
            $schedule->debit = 0;
            $schedule->save();
        }
    }
}
