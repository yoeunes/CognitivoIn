<?php

namespace App\Http\Controllers\Api;

use App\Item;
use App\Relationship;
use App\Profile;
use App\Currency;
use App\Scheduals;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiController extends Controller
{
  public function list_items(Profile $profile,$skip)
  {
    // if (isset($location_slug)) {
    //     $items =Item::GetItems($profile->id)
    //     ->join('item_movements', 'items.id', 'item_movements.item_id')
    //     ->where('location_id',$location_slug)
    //     ->groupBy('item_movements.item_id')
    //     ->get();
    // }
    // else {

    $items =Item::GetItems($profile->id)
    ->skip($skip)
      ->take(100)
      ->get();
    //    }

    return response()->json($items);
  }
  public function list_itemsByID(Profile $profile,$id)
  {


    $items =Item::GetItems($profile->id)
    ->where('id',$id)

      ->get();


    return response()->json($items);
  }
  public function list_customers(Profile $profile,$skip)
  {

    $customers = Relationship::GetCustomers()->skip($skip)
      ->take(100)->get();

    return response()->json($customers);
  }
  public function list_customersByID(Profile $profile,$id)
  {


    $customers =Relationship::GetCustomers($profile->id)
    ->where('id',$id)

      ->get();


    return response()->json($customers);
  }
  public function list_suppliers(Profile $profile)
  {
    $suppliers = Relationship::GetSuppliers()->get();

    return response()->json($suppliers);
  }
  public function list_currency(Profile $profile)
  {
    $suppliers = Currency::get();

    return response()->json($suppliers);
  }
  public function list_account_receivables(Profile $profile,$customer_ID)
  {
    $suppliers = Scheduals::
    Join('relationships','relationships.id','=','scheduals.relationship_id')
    ->where('relationships.customer_id',$customer_ID)
    ->get();

    return response()->json($suppliers);
  }
  public function list_account_payables(Profile $profile,$supplier_ID)
  {
    $suppliers = Scheduals::
    Join('relationships','relationships.id','=','scheduals.relationship_id')
    ->where('relationships.supplier_id',$supplier_ID)
    ->get();

    return response()->json($suppliers);
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
    return response()->json($relationship);
  }








}
