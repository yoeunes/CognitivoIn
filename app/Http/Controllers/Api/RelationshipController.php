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
    public function search(Profile $profile, $query)
    {
        $customers = Relationship::GetCustomers()
        ->where('customer_alias', $query)
        ->orWhere('customer_taxid', $query)
        ->get();
    }

    public function list_customers(Request $request, Profile $profile)
    {
        $customers = Relationship::GetCustomers()
        ->skip($skip)
        ->take(100)
        ->get();

        return response()->json($customers);
    }
    public function getCustomer(Profile $profile,$id)
    {
        $customers =Relationship::find($id);


        return response()->json($customers);
    }

    public function syncCustomers(Request $request, Profile $profile)
    {
        $collection = collect();

        if ($request->all() != [])
        {
            $customers = $request->all();
            $collection = collect($customers);
        }

        $collection = json_decode($collection->toJson());
        $counter = 0;

        $processedCustomers = new Collection();


        foreach ($collection as $element)
        {

            $processedCustomers->push($this->createOrUpdate_Customer($element));
            $counter += 1;
        }

        //Return CloudID back to Client Application for processing.
        return response()->json($processedCustomers, 200);
    }

    public function createOrUpdateCustomer(Request $request,Profile $profile, $data)
    {


        $relationship = Relationship::GetCustomers()->where('id', $data->cloud_id)->first();

        if (isset($relationship) == false)
        {
            $relationship = Relationship::GetCustomers()
            ->where('customer_alias', $query)
            ->orWhere('customer_taxid', $query)->first() ?? new Relationship();
        }


        $relationship->supplier_id = $profile->id;
        $relationship->supplier_accepted = true;

        $relationship->customer_taxid = $data->taxid;
        $relationship->customer_alias = $data->alias;
        $relationship->customer_address = $data->address;
        $relationship->customer_telephone = $data->telephone;
        $relationship->customer_email = $data->email;
        $relationship->save();
        $data->cloud_id = $relationship->id;
        return response()->json($relationship);
    }

    public function customers(Profile $profile,Request $request)
     {

       $relationship= new Relationship();
       $relationship->supplier_id = $profile->id;
       $relationship->customer_taxid=$request['taxid'];
       $relationship->customer_alias=$request['alias'];
       $relationship->customer_address=$request['address'];
       $relationship->customer_telephone=$request['telephone'];
       $relationship->customer_email=$request['email'];
       $relationship->supplier_accepted=true;
       $relationship->save();
       return response()->json($relationship,200);
     }


    public function list_suppliers(Profile $profile)
    {
        $suppliers = Relationship::GetSuppliers()->get();
        return response()->json($suppliers);
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
