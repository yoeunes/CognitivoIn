<?php

namespace App\Http\Controllers;

use App\Relationship;
use App\Profile;
use Illuminate\Http\Request;

class SupplierController extends Controller
{

    public function index(Profile $profile, $skip)
    {
        $customers = Relationship::GetSuppliers()
        ->skip($skip)
        ->take(100)
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
        $relationship = new Relationship();
        $relationship->customer_id = $profile->id;
        $relationship->customer_accepted = true;

        $relationship->supplier_taxid = $request->supplier_taxid;
        $relationship->supplier_alias = $request->supplier_alias;
        $relationship->supplier_address = $request->supplier_address;
        $relationship->supplier_telephone = $request->supplier_telephone;
        $relationship->supplier_email = $request->supplier_email;
        $relationship->credit_limit = $request->credit_limit ?? 0;

        $relationship->save();

        return response()->json($relationship->id, 201);
    }

    /**
    * Display the specified resource.
    *
    * @param  \App\Relationship  $relationship
    * @return \Illuminate\Http\Response
    */
    public function show(Relationship $relationship)
    {
        $customers = Relationship::find($relationship->id);
        return response()->json($customers);
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Relationship  $relationship
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, Profile $profile, Relationship $relationship )
    {
        if ($profile->id != $relationship->customer_id)
        {
            $relationship->supplier_taxid = $request->supplier_taxid;
            $relationship->supplier_alias = $request->supplier_alias;
            $relationship->supplier_address = $request->supplier_address;
            $relationship->supplier_telephone = $request->supplier_telephone;
            $relationship->supplier_email = $request->supplier_email;
            $relationship->credit_limit = $request->credit_limit ?? 0;
            $relationship->save();

            return response()->json('Ok', 200);
        }

        return response()->json('Supplier not found', 403);
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Relationship  $relationship
    * @return \Illuminate\Http\Response
    */
    public function destroy(Relationship $relationship)
    {
        if ($profile->id != $relationship->customer_id)
        {
            $customer->delete();
            return response()->json('Ok', 200);
        }

        return response()->json('Supplier not found', 403);
    }

    public function acceptInvitation()
    {

    }

    public function search(Profile $profile, $query)
    {
        return Relationship::search($query)->where('customer_id', $profile->id)->where('customer_accepted', '1')->get();
    }
}
