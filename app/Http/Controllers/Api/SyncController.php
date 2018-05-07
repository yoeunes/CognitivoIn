<?php

namespace App\Http\Controllers\Api;

use App\Item;
use App\Relationship;
use App\Profile;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SyncController extends Controller
{
    public function convert_date($date)
    {
        $trans_date = $date;

        preg_match('/(\d{10})(\d{3})/', $date, $matches);

        $trans_date = Carbon::createFromTimestamp($matches[1]);
        // Log::info('fecha: '. $trans_date);
        return $trans_date;
    }

    public function syncItems(Request $request, Profile $profile)
    {

        $collection = collect();

        if ($request->all() != [])
        {
            $items = $request->all();
            $collection = collect($items);
        }

        $collection = json_decode($collection->toJson());
        $counter = 0;
        foreach ($collection as $key => $element)
        {
            $this->createOrUpdate_Item($element);
            $counter += 1;
        }

        return response()->json('Sucess, ' . $counter . ' records updated.');
    }
    public function createOrUpdate_Item($data)
    {
        $profile = request()->route('profile');

        $item = Item::GetItems($profile)->where('name', $data->name)->where('sku', $data->code)->first();

        if (!isset($item))
        {
            $item = new Item();
            $item->profile_id = $profile->id;

            $item->name = mb_strimwidth($data->name, 0, 187, '...');
            $item->sku = $data->code;
            $item->short_description = $data->comment;
            $item->unit_price = $data->unit_price;
            $currency = Currency::first();
            $item->currency_id =$currency->id;
            $item->save();
            $data->cloud_id=$item->id;
        }

        return $item;
    }

    public function syncCustomer(Request $request, Profile $profile)
    {

        $collection = collect();

        if ($request->all() !=  []) {
            $items = $request->all();
            $collection = collect($items);
        }

        $collection = json_decode($collection->toJson());

        foreach ($collection as $key  => $element)
        {
            $item = Relationship::GetCustomers()
            ->where('customer_alias', $element->name)
            ->where('customer_taxid', $element->govcode)
            ->first();

            if (!isset($item))
            {
                $relationship = new Relationship();

                $relationship->supplier_id = $profile->id;
                $relationship->supplier_accepted = true;

                $relationship->customer_taxid = $element->govcode;
                $relationship->customer_alias = $element->name;
                $relationship->customer_address = $element->address;
                $relationship->customer_telephone = $element->telephone;
                $relationship->customer_email = $element->email;
                $relationship->save();
            }
        }
        return response()->json('Sucess');
    }
    public function uploadOrder (Request $request, Profile $profile)
    {
        $data = collect();

        if ($request->all() != [])
        {
            $data = collect($request->all());
        }

        $collection = json_decode($data->toJson());

        foreach ($collection as $key => $data)
        {
            //Check to see if Reference exists in System.
            $order = Order::FromCustomers()->where('ref_id', $data->my_id)->select('orders.id')->first();

            //If Exists == false, create Order, link Relationship and use.
            if(isset($order))
            {
                $order = Order::where('id',$order->id)->with('details')->first();
            }
            else
            {
                $order = new Order();
                $order->relationship_id = $this->checkCreateRelationships($profile, $data)->id;
            }

            //fill up data regardless if exists or not. this will allow new data to prevail.
            $data->customer->cloud_id=$order->relationship_id;
            $this->loadData_Order($order, $data);
        }

        return response()->json($collection);
    }

    // This function will create or update an existing Order with the new data inserted.
    public function loadData_Order ($order, $data)
    {
        $profile = request()->route('profile');
        $order->ref_id = $data->my_id;
        $order->number = $data->number;
        $order->is_printed = $data->number != "" ? true : false;
        $order->trans_date =$this->convert_date($data->trans_date);
        $order->credit_days = $data->credit_days;
        $branch = Location::where('profile_id', $profile->id)->where('name', $data->branch_name)->first();

        if (!isset($branch)) {
            $branch = new Location();
            $branch->profile_id=$profile->id;
            $branch->name=$data->branch_name;
            $branch->save();
        }

        $order->location_id =$branch->id;
        $currency = Currency::first();

        if (!isset($currency)) {
            currency()->create([
                'name' => 'U.S. Dollar',
                'code' => 'USD',
                'symbol' => '$',
                'format' => '$1,0.00',
                'exchange_rate' => 1.00000000,
                'active' => 1,
            ]);
        }

        $currency = Currency::first();
        $order->currency_id =$currency->id;
        $order->currency_rate = $data->currency_rate;
        $order->comment = $data->comment;

        $order->save();

        //assign id to collection.
        $data->ref_id=$order->id;

        //Is it possible to use $order instead of getting fresh data from db?
        //$order = Order::where('id', $order->id)->with('details')->first();

        foreach ($data->details as $data_detail)
        {
            $detail = $order->details->where('ref_id', $data->my_id)->first(); //OrderDetail::where('ref_id', $id_ref)->first();

            if(isset($detail) == false)
            {
                $detail = new OrderDetail();
                $detail->order_id = $order->id;
            }

            $item = $this->createOrUpdate_Item($data_detail->item);

            $detail->item_id = $item->id;
            $detail->ref_id = $data_detail->my_id;
            $detail->quantity = $data_detail->quantity;
            $detail->unit_price = $data_detail->price;
            //$detail->discount = $data->discount;
            $detail->save();
            $data_detail->ref_id=$detail->id;
        }
    }

    public function checkCreateRelationships($profile, $data)
    {
        $customers = Relationship::GetCustomers()
        ->where('customer_alias', $data->customer->name)
        ->where('customer_taxid', $data->customer->govcode)
        ->first();

        if (isset($customers))
        {
            return $customers;
        }
        else
        {

            $relationship = new Relationship();

            $relationship->supplier_id = $profile->id;
            $relationship->supplier_accepted = true;

            if ($data->customer != null)
            {
                $relationship->customer_taxid = $data->customer->govcode;
                $relationship->customer_alias = $data->customer->name;
                $relationship->customer_address = $data->customer->address;
                $relationship->customer_telephone = $data->customer->telephone;
                $relationship->customer_email = $data->customer->email;
            }

            $relationship->save();

            return $relationship;
        }
    }

    public function syncTransactionStatus(Request $request, Profile $profile)
    {
        $collection = collect();

        if ($request->all() != [])
        {
            $transactions = $request->all();
            $collection = collect($transactions);
        }

        $collection = json_decode($collection->toJson());
        foreach ($collection as $key => $element)
        {
            $transaction=$this->checkOrder($element->id_ref);
            if(isset($transaction))
            {
                $transaction->ref_id = $element->id_sales_invoice;
                $transaction->save();
                $orderstatus = $this->UpdateDetail($transaction,$element->details);
                if (isset($orderstatus))
                {
                    $orderstatus->status = 3;
                    $orderstatus->save();
                }
                else
                {
                    $orderstatus = new OrderStatus();
                    $orderstatus->order_id = $order->id;
                    $orderstatus->status = 3;
                    $orderstatus->save();
                }
            }
        }
    }

    public function downloadOrder (Request $request, Profile $profile)
    {
        $orders = Order::FromCustomers()
        ->leftJoin('order_status','orders.id','=','order_status.order_id')
        ->with('details')
        ->whereNull('ref_id')
        ->where('order_status.status','=',2)
        ->select('orders.id','orders.ref_id','orders.location_id',
        'orders.classification_id','orders.recurring_order_id','orders.buyer_profile_id',
        'orders.salesrep_profile_id','orders.relationship_id','customer_alias'
        ,'customer_taxid','customer_address','customer_telephone','customer_email')
        ->get();
        return response()->json($orders);
    }
}
