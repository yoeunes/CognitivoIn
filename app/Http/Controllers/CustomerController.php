<?php

namespace App\Http\Controllers;

use App\Relationship;
use App\Profile;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index(Profile $profile)
  {
    $customers = Relationship::GetCustomers()->get();
    return view('company.sales.customer.list')->with('customers',$customers);
  }
  public function list_customers(Profile $profile,$skip)
  {

    $customers = Relationship::GetCustomers()->skip($skip)
    ->take(100)->get();

    return response()->json($customers);
  }
  public function getAllCustomer(Profile $profile)
  {

    $customers = Relationship::GetCustomers()
    ->get();
    return response()->json($customers);
  }
  public function list_customersByID(Profile $profile,$id)
  {


    $customers =Relationship::GetCustomers($profile->id)
    ->where('id',$id)

    ->get();


    return response()->json($customers);
  }
  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create(Profile $profile)
  {
    return view('company.sales.customer.form');
  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function store(Request $request ,Profile $profile)
  {

    $relationship = $request->id == 0 ? new Relationship()
    : Relationship::where('id', $request->id)->first();


    $relationship->supplier_id = $profile->id;
    $relationship->customer_taxid=$request->customer_taxid;
    $relationship->customer_alias=$request->customer_alias;
    $relationship->customer_address=$request->customer_address;
    $relationship->customer_telephone=$request->customer_telephone;
    $relationship->customer_email=$request->customer_email;
    $relationship->supplier_accepted=true;

    $relationship->save();


    return response()->json('ok',200);
  }
  public function save_customer(Request $request ,Profile $profile)
  {
    $relationship= new Relationship();

    $relationship->supplier_id = $profile->id;
    $relationship->customer_taxid=$request->taxid;
    $relationship->customer_alias=$request->alias;
    $relationship->customer_address=$request->address;
    $relationship->customer_telephone=$request->telephone;
    $relationship->customer_email=$request->email;
    $relationship->supplier_accepted=true;

    $relationship->save();
    return response()->json($relationship);

  }


  /**
  * Display the specified resource.
  *
  * @param  \App\Relationship  $relationship
  * @return \Illuminate\Http\Response
  */
  public function show(Relationship $relationship)
  {
    //
  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  \App\Relationship  $relationship
  * @return \Illuminate\Http\Response
  */
  public function edit(Profile $profile,Relationship $customer)
  {

    return view('company.sales.customer.form')->with('customer',$customer);
  }

  /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  \App\Relationship  $relationship
  * @return \Illuminate\Http\Response
  */
  public function update(Request $request, Profile $profile,Relationship $customer )
  {

    $relationship->customer_taxid = $request->taxid;
    $relationship->customer_alias = $request->alias;
    $relationship->customer_address = $request->address;
    $relationship->customer_telephone = $request->telephone;
    $relationship->customer_email = $request->email;
    $relationship->supplier_accepted=true;
    $relationship->save();

    $customers = Relationship::GetCustomers()->get();
    return view('company.sales.customer.list')->with('customers',$customers);
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  \App\Relationship  $relationship
  * @return \Illuminate\Http\Response
  */
  public function destroy(Relationship $customer)
  {
    $customer->delete();
    $customers=Relationship::GetCustomers()->get();
    return view('company.sales.customer.list')->with('customers',$customers);

  }

  public function getCustomer(Profile $profile,$id)
  {
    $customers=Relationship::GetCustomers()->where('id',$id)->first();
    return response()->json($customers);
  }
}
