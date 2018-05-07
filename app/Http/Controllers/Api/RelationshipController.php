<?php

namespace App\Http\Controllers\Api;

use App\Item;
use App\Relationship;
use App\Profile;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RelationshipController extends Controller
{
    //Customer Controller
    public function searchCustomer(Profile $profile, $query)
    {
        $customers = Relationship::GetCustomers()
        ->where('customer_alias', $query)
        ->orWhere('customer_taxid', $query)
        ->first();
    }

    public function listCustomers(Request $request, Profile $profile)
    {

    }

    public function createCustomer(Request $request, Profile $profile)
    {
        $relationship = new Relationship();
        $relationship->supplier_id = $profile->id;
        $relationship->supplier_accepted = true;

        $relationship->customer_taxid = $request['taxid'];
        $relationship->customer_alias = $request['alias'];
        $relationship->customer_address = $request['address'];
        $relationship->customer_telephone = $request['telephone'];
        $relationship->customer_email = $request['email'];
        $relationship->save();

        return response()->json($relationship);
    }

    public function editCustomer(Request $request, Profile $profile)
    {

    }

    public function list_customers(Profile $profile,$skip)
    {
        $customers = Relationship::GetCustomers()->skip($skip)
        ->take(100)->get();

        return response()->json($customers);
    }

    public function list_customersByID(Profile $profile,$id)
    {
        $customers = Relationship::GetCustomers($profile->id)
        ->where('id',$id)
        ->get();

        return response()->json($customers);
    }

    public function list_suppliers(Profile $profile)
    {
        $suppliers = Relationship::GetSuppliers()->get();
        return response()->json($suppliers);
    }


    public function syncCustomer(Request $request, Profile $profile)
    {
        $collection = collect();

        if ($request->all() != [])
        {
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

        return response()->json('Sucess', 200);
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
}
