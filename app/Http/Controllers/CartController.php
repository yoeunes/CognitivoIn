<?php

namespace App\Http\Controllers;
use App\Profile;
use App\Opportunity;
use App\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index(Profile $profile, $skip, $filterBy)
  {
    $carts = Cart::FromCustomers()
    ->skip($skip)
    ->take(100)
    ->get();

    return response()->json($carts);
  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function store(Request $request, Profile $profile, $opportunity)
  {

    $opportunity=Opportunity::find($opportunity);


    $count= Cart::where('item_id',$request->item_id)
    ->where('opportunity_id',$opportunity->id)->get()->count();
    if ($count==0) {
      $cart = new Cart();
      $cart->opportunity_id = $opportunity->id;
      $cart->relationship_id = $request->relationship_id;
      $cart->item_id =$request->item_id;
      $cart->quantity =1;
      $cart->unit_price =$request->unit_price;
      $cart->vat_id =$request->vat_id;
      $cart->status =1;
      $cart->save();
    }
    else {
      $cart=Cart::where('item_id',$request->item_id)
      ->where('opportunity_id',$opportunity->id)->first();
    }


    $cart=Cart::where('id',$cart->id)->with('item')->first();
    return response()->json($cart, 200);
  }

  public function update(Request $request, Profile $profile,$opportunity, $cart)
  {
      $cart=Cart::where('id',$cart)->first();
      $cart->quantity=$request->quantity;
      $cart->save();
        return response()->json('Ok', 200);
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  \App\OpportunityMember  $opportunityMember
  * @return \Illuminate\Http\Response
  */
  public function destroy(Profile $profile,$id,$cartID)
  {
    //No authentication check, figure out later based on user role if they can delete or not.
    //No need for soft delete.
    $cart =  Cart::find($cartID);
    $cart->forceDelete();
    return response()->json('Ok', 200);
  }
}
