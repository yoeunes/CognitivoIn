<?php

namespace App\Http\Controllers\Api;

use App\Item;
use App\Relationship;
use App\Profile;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AccountController extends Controller
{
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

    public function get_CustomerSchedual(Request $request, Profile $profile)
    {
        //return payment schedual. history of unpaid debt. by Customer TaxID
    }

    public function recievePayment(Request $request, Profile $profile)
    {
        //Store payment information recieved by client application
    }

    public function annullPayment(Request $request, Profile $profile)
    {
        //in request, take paymentID given by previous payment to annull value
    }
}
