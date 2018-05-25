<?php

namespace App\Http\Controllers;

use App\Relationship;
use App\Profile;
use Illuminate\Http\Request;

class CustomerController extends Controller
{

    public function index(Profile $profile, $skip)
    {

        $customers = Relationship::GetCustomers()
        ->skip($skip)
        ->take(100)
        ->get();

        return response()->json($customers);
    }

    public function getAllCustomer (Profile $profile)
    {
        $customers = Relationship::GetCustomers()
        ->get();

        return response()->json($customers);
    }

    public function getCustomer (Profile $profile,$frase)
    {

        $customers = Relationship::GetCustomers()
        ->where('customer_alias', 'LIKE', "%$frase%")
        ->orWhere('customer_taxid', 'LIKE', "%$frase%")

        ->get();

        return response()->json($customers);
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request, Profile $profile)
    {
        $relationship = $request->id == 0 ? new Relationship() : Relationship::where('id', $request->id)->first();
        $relationship->supplier_id = $profile->id;
        $relationship->supplier_accepted = true;

        $relationship->customer_taxid = $request->customer_taxid;
        $relationship->customer_alias = $request->customer_alias;
        $relationship->customer_address = $request->customer_address;
        $relationship->customer_telephone = $request->customer_telephone;
        $relationship->customer_email = $request->customer_email;
        $relationship->credit_limit = $request->credit_limit ?? 0;
        $relationship->contract_ref = $request->contract_ref ?? 0;

        $relationship->save();

        return response()->json($relationship, 201);
    }

    /**
    * Display the specified resource.
    *
    * @param  \App\Relationship  $relationship
    * @return \Illuminate\Http\Response
    */
    public function edit(Profile $profile, $relationshipID)
    {
        return response()->json(Relationship::find($relationshipID));
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Relationship  $relationship
    * @return \Illuminate\Http\Response
    */
    public function destroy(Relationship $relationship)
    {
        if ($profile->id != $relationship->supplier_id)
        {
            $customer->delete();
            return response()->json('Ok', 200);
        }

        return response()->json('Customer not found', 403);
    }

    public function acceptInvitation()
    {

    }

    public function search(Profile $profile, $query)
    {
        return Relationship::search($query)->where('supplier_id', $profile->id)->where('supplier_accepted', '1')->get();
    }
}
