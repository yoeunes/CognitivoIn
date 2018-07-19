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
use App\ItemPromotion;
use App\Http\Resources\OrderResource;
use Swap\Laravel\Facades\Swap;
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
    public function index(Profile $profile, $filterBy)
    {
        return OrderResource::collection(
            Order::mySales()->with('relationship')
            ->with('details')
            ->paginate(25)
        );

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
            $order = Order::mySales()
            ->where('id', $request->cloud_id)
            ->with('details')
            ->first()
            ??
            new Order();

            $order->relationship_id = $request->relationship_cloud_id;
            $order->currency = $request->currency ?? $profile->currency;
            $order->currency_rate = ($request->rate ?? Swap::latest($profile->currency . '/' . $request->currency)->getValue()) ?? 1;
            $order->is_impex = $request->is_impex ?? 0;
            $order->is_printed = $request->is_printed ?? 0;
            $order->is_archived = $request->is_archived ?? 0;

            $order->save();

            foreach ($request->details as $detail)
            {
                $orderDetail = $order->details->where('id', $detail['detail_cloud_id'])->first() ?? new OrderDetail();
                $orderDetail->order_id = $order->id;
                $orderDetail->item_id = $detail['item_id'];
                $orderDetail->item_sku = $detail['sku'];
                $orderDetail->item_name = $detail['name'];
                $orderDetail->quantity = $detail['quantity'];
                $orderDetail->unit_price = $detail['price'];

                $orderDetail->save();
            }
            //TODO run this code on approve or individual check if user wish.

            // $details = OrderDetail::where('order_id',  $order->id)
            // ->select(DB::raw('item_id'),
            // DB::raw('round(sum(quantity),2) as quantity'))
            // ->groupBy('item_id')->get();
            //
            // foreach ($details as $detail)
            // {
            //     $promotions = ItemPromotion::where('input_id',$detail['item_id'])->get();
            //     foreach ($promotions as $promotion)
            //     {
            //         if ($promotion->type==1 && $promotion->input_value==$detail['quantity'])
            //         {
            //             $item=Item::where('id',$promotion->output_id)->first();
            //             $orderDetail = new OrderDetail();
            //             $orderDetail->order_id = $order->id;
            //             $orderDetail->item_id = $promotion->output_id;
            //             $orderDetail->item_sku = $item->sku;
            //             $orderDetail->item_name = $item->name;
            //             $orderDetail->quantity = $promotion->output_value;
            //             $orderDetail->unit_price = $item->unit_price;
            //
            //             $orderDetail->save();
            //         }
            //     }
            // }

            return response()->json('Ok', 200);
        }

        return response()->json('Resource not found', 403);
    }

    /**
    * Display the specified resource.
    *
    * @param  \App\Order  $order
    * @return \Illuminate\Http\Response
    */
    public function show(Profile $profile, $orderID)
    {
        $order = Order::mySales()
        ->where('id', $orderID)
        ->with('details')
        ->first();

        if (isset($order))
        { return response()->json($order); }
        else
        { return response()->json('Forbidden', 403); }

    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Order  $order
    * @return \Illuminate\Http\Response
    */
    public function edit(Profile $profile, Order $order)
    {
        $order = Order::mySales()
        ->where('orders.id', $order->id)
        ->with('details')
        ->first();

        if (isset($order))
        { return response()->json($order); }
        else
        { return response()->json('Forbidden', 403); }
    }

    public function destroy(Order $order)
    {
        //
    }

    public function approve(Profile $profile, $orderID)
    {
        $order = Order::mySales()
        ->where('id', $orderID)
        ->with('details')
        ->first();

        if (isset($order))
        {
            return response()->json('Resource not found', 404);
        }

        if ($order->status == 2)
        {
            //If status 3, then you cannot annull as it is already annulled.
            return response()->json('Forbidden. Order is already approved', 403);
        }

        $amount = 0;
        $vatAmount = 0;

        //for payment entry
        if ($order->contract_id > 0)
        {
            $contractDetails = ContractDetail::where('contract_id', $order->contract_id)->get();
            $schedualAmount = 0;

            foreach ($contractDetails as $detail)
            {
                $schedule = new Schedule();
                $schedule->order_id = $order->id;
                $schedule->relationship_id = $order->relationship_id;
                $schedule->reference = $order->number;
                $schedule->currency = $order->currency;
                $schedule->currency_rate = $order->currency_rate ?? 1;
                $schedule->date = $order->date ?? Carbon::now();
                $schedule->due_date = $schedule->date->addDays($detail->offset);
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
            $schedule->order_id = $order->id;
            $schedule->relationship_id = $order->relationship_id;
            $schedule->reference = $order->number;
            $schedule->currency = $order->currency;
            $schedule->currency_rate = $order->currency_rate;
            $schedule->date = Carbon::now();
            $schedule->due_date = Carbon::now();
            $schedule->value = $amount;
            $schedule->save();
        }
    }
    //
    // public function stockEntry($order)
    // {
    //     foreach ($order->details as  $detail)
    //     {
    //         $vatDetails = VatDetail::where('vat_id', $detail->vat_id)->get();
    //
    //         foreach ($vatDetails as $vat)
    //         {
    //             $vatAmount = $vatAmount + (($detail->unit_price * $vat->percent) *  $vat->coefficient);
    //         }
    //
    //         $amount = $amount + (($detail->unit_price + $vatAmount) * $detail->quantity);
    //
    //         //TODO Get only required column. you are using one column only.
    //         $item = Item::find($detail->item_id);
    //
    //         if ($item->is_stockable && $order->location_id != null)
    //         {
    //             $movement = new ItemMovement();
    //             $movement->item_id = $item->id;
    //             $movement->order_id = $order->id;
    //             $movement->location_id = $order->location_id;
    //             $movement->date = Carbon::now();
    //             $movement->credit = 0;
    //             $movement->debit = $detail->quantity;
    //             $movement->save();
    //         }
    //     }
    // }

    //TODO make annull code for order.
    public function annul(Profile $profile, $orderID)
    {
        $order = Order::mySales()
        ->where('id', $orderID)
        ->with('detail')
        ->first();

        if (isset($order))
        {
            return response()->json('Resource not found', 404);
        }

        if ($order->status == 3)
        {
            //If status 3, then you cannot annull as it is already annulled.
            return response()->json('Forbidden. Order is already annulled', 403);
        }

        $amount = 0;
        $vatAmount = 0;

        //Get list of stock movements generated from
        $movements = ItemMovement::whereIn('id', [$order->details->movement_id])->get();

        foreach ($movements as $movement)
        {
            $details = $order->details->where('movement_id', $movement->id)->get();

            //check if movement quantity = detail quantity
            if ($movement->debit == $details->sum('quantity'))
            {
                //if movement equals to detail quantity, then delete.
                $movement->delete();
            }
            else
            {
                //if not, other transactionsa are included. so discount quantity but keep record.
                $movement->debit = $movement->debit - $details->sum('quantity');
                $movement->save();
            }
        }

        //for payment entry
        $schedule = new Schedule();

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
    }

    //
    public function checkPromotion()
    {

    }
}
