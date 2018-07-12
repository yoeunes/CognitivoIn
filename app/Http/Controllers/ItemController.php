<?php

namespace App\Http\Controllers;

use App\Item;
use App\ItemReview;
use App\ItemFaq;
use App\Profile;
use App\Http\Resources\ItemResource;
use Illuminate\Http\Request;
use Auth;
use DB;

class ItemController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    //for list of items
    public function index(Profile $profile, $filterBy)
    {
        return ItemResource::collection(Item::GetItems($profile->id)->with(['vat' => function($query)
    {

        $query->with("details");}

])->paginate(100));
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
        $item = Item::where('id', $request->id)->first() ?? new Item();
        $item->profile_id = $profile->id;
        $item->sku = $request->sku;
        $item->name = $request->name;
        $item->short_description = $request->short_description;
        $item->long_description = $request->long_description;
        $item->unit_price = $request->unit_price;
        $item->currency = $request->currency ?? $profile->currency;
        $item->item_id = $request->item_id;
        $item->vat_id = $request->vat_id;
        $item->is_stockable = $request->is_stockable;
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
    public function edit(Profile $profile, Item $item)
    {
        return response()->json($item);
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Item  $item
    * @return \Illuminate\Http\Response
    */
    public function destroy(Profile $profile, Item $item)
    {
        if ($item->profile_id == $profile->id)
        {
            //Soft Delete
            $item->delete();
            return response()->json('Done', 200);
        }

        return response()->json('Resource not found', 401);
    }

    //Force Destroy an Item
    public function forceDestroy(Profile $profile, Item $item)
    {
        if ($item->profile_id == $profile->id)
        {
            try
            {
                $item->forceDelete();
                return response()->json('Done', 200);
            }
            catch (\Exception $e)
            {
                return response()->json('Resource used elsewhere. Unable to Delete.', 500);
            }
        }

        return response()->json('Resource not found', 401);
    }

    public function askQuestion(Request $request, $profileSlug, Item $item)
    {
        $faq = new ItemFaq();
        $faq->comment = $request->question;
        $faq->item_id = $item->id;
        $faq->profile_id = Auth::user()->profile_id;
        $faq->type = 1; //Question
        $faq->save();

        return response()->json('Done', 200);
    }

    public function answerQuestion(Request $request, $profileSlug, Item $item)
    {
        $faq = new ItemFaq();
        $faq->item_faq_id = $request->item_faq_id;
        $faq->comment = $request->answer;
        $faq->item_id = $item->id;
        $faq->profile_id = Auth::user()->profile_id;
        $faq->type = 2; //Answer
        $faq->save();

        return response()->json('Done', 200);
    }

    public function rateItem($profileSlug, Item $item, $intRate)
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
        return response()->json('Done', 200);
    }

    //TODO: Change this query. keep item search simple
    public function search(Profile $profile, $query)
    {
        $items = null;

        if (strlen($query) >= 3)
        {
          //  $items = Item::search($query)->where('profile_id', $profile->id)->get();

            $items = Item::where('items.profile_id', $profile->id)
            ->where('items.name', 'LIKE', "%" . $query . "%")
            ->orWhere('items.sku', 'LIKE', "%" . $query . "%")
            ->leftJoin('vats', 'items.vat_id', 'vats.id')
            ->leftJoin('vat_details', 'vat_details.vat_id', 'vats.id')
            ->select(DB::raw('max(items.id) as id'),
            DB::raw('max(items.name) as name'),
            DB::raw('max(items.sku) as sku'),
            DB::raw('max(items.unit_price) as unit_price'),
            DB::raw('max(items.unit_price) + (max(items.unit_price)*sum(vat_details.coefficient)) as unit_price_vat')
            )
            ->groupBy('items.id')
            ->take(15)
            ->get();
        }

        return response()->json($items);
    }
}
