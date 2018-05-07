<?php

namespace App\Http\Controllers;

use App\Item;
use App\ItemReview;
use App\ItemFaq;
use App\Profile;
use App\Currency;
use Illuminate\Http\Request;
use Auth;

class ItemController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(Profile $profile)
    {
        $items = Item::GetItems($profile->id)->get();
        return view('company.stock.items.list')
        ->with('items', $items);
    }

    public function list_items(Profile $profile,$skip)
    {
        $items = Item::GetItems($profile->id)
        ->skip($skip)
        ->take(100)
        ->get();

        return response()->json($items);
    }

    public function get_items(Profile $profile)
    {
        $items = Item::GetItems($profile->id)
        ->get();

        return response()->json($items);
    }

    public function list_itemsByID(Profile $profile,$id)
    {
        $items = Item::GetItems($profile->id)
        ->where('id',$id)
        ->get();

        return response()->json($items);
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create(Profile $profile)
    {
        return view('back_office.items.form');
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request, Profile $profile)
    {

        $item = $request->id == 0 ? new Item() : Item::where('id', $request->id)->first();
        $item->profile_id = $profile->id;

        $currency = null;
        $currencies = Currency::GetCurrencies();

        if (count($currencies) == 0)
        {
            $currency = new Currency();
            $currency->name ='US Dollar';
            $currency->code ='USD';
            $currency->symbol ='$';
            $currency->format ='$1.0.00';
            $currency->exchange_rate = 0;
            $currency->active = 0;
            $currency->save();
        }
        else
        {
            $currency = $currencies->first();
        }

        $item->currency_id = $currency->id;
        $item->sku = $request->sku;
        $item->name = $request->name;
        $item->short_description = $request->short_description;
        $item->long_description = $request->long_description;
        $item->unit_price = $request->unit_price;
        $item->is_active = $request->is_active == 'on' ? true : false;

        $item->save();
        return response()->json('ok', 200);
    }

    /**
    * Display the specified resource.
    *
    * @param  \App\Item  $item
    * @return \Illuminate\Http\Response
    */
    public function show(Profile $profile, Item $item)
    {
        //
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Item  $item
    * @return \Illuminate\Http\Response
    */
    public function edit(Profile $profile,Item $item)
    {
        return view('company.stock.items.form')->with('item',$item);
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Item  $item
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, Profile $profile, Item $item)
    {
        $item->profile_id = $profile->id;
        $item->sku = $request->sku;
        $item->name = $request->name;
        $item->short_description = $request->short_description;
        $item->long_description = $request->long_description;
        $item->unit_price = $request->unit_price;
        $item->is_active = $request->is_active == 'on' ? true : false;
        $item->save();

        $items = Item::where('profile_id', $profile->id)->get();

        return view('company.stock.items.list')->with('items', $items);
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Item  $item
    * @return \Illuminate\Http\Response
    */
    public function destroy(Profile $profile,Item $item)
    {

        $item->delete();
        $items = Item::where('profile_id',$profile->id)->get();
        return view('company.stock.items.list')
        ->with('items',$items);

    }

    public function askQuestion(Request $request, Profile $profile, Item $item)
    {
        $faq = new ItemFaq();
        $faq->comment = $request->question;
        $faq->item_id = $item->id;
        $faq->profile_id = Auth::user()->profile_id;
        $faq->type = 1; //Question

        $faq->save();

        return redirect()->back();
    }

    public function rateItem(Profile $profile, Item $item, $intRate)
    {
        $rate = ItemReview::where('profile_id', Auth::user()->profile_id)->first();

        if ($rate == null)
        {
            $rate = new ItemReview();
            $rate->item_id = $item->id;
            $rate->profile_id = Auth::user()->profile_id;
            $rate->review = "";
        }

        $rate->rating = $intRate;
        $rate->save();

        return redirect()->back();
    }
}
