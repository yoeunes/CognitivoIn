<?php

namespace App\Http\Controllers;

use App\ItemPromotion;
use App\Profile;
use App\Enums\ItemPromotionType;
use App\Enums\LocationPromotionType;
use Illuminate\Http\Request;
use App\Http\Resources\ItemResource;

class ItemPromotionController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(Profile $profile, $filterBy)
    {
        return ItemResource::collection(ItemPromotion::paginate(25));
    }
    public function getPromotionTypeByItem(Profile $profile)
    {
        $data = [];
        foreach (ItemPromotionType::labels() as $value => $label)
        {
            $data[] = [
                'id' => $value,
                'name' => $label
            ];
        }
        return response()->json($data);
    }
    public function getPromotionTypeByLocation(Profile $profile)
    {
        $data = [];
        foreach (LocationPromotionType::labels() as $value => $label)
        {
            $data[] = [
                'id' => $value,
                'name' => $label
            ];
        }
        return response()->json($data);
    }
    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {

    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        $promotion = $request->id == 0 ? new ItemPromotion() : ItemPromotion::where('id', $request->id)->first();

        $promotion->type = $request->type;
        $promotion->input_id = $request->input_id;
        $promotion->output_id = $request->output_id;
        $promotion->input_value = $request->input_value;
        $promotion->output_value = $request->output_value;
        $promotion->start_date = $request->start_date;
        $promotion->end_date = $request->end_date;

        $promotion->save();

        return response()->json($promotion, 201);
    }

    /**
    * Display the specified resource.
    *
    * @param  \App\ItemPromotion  $itemPromotion
    * @return \Illuminate\Http\Response
    */
    public function show($itemPromotionID)
    {

    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\ItemPromotion  $itemPromotion
    * @return \Illuminate\Http\Response
    */
    public function edit(ItemPromotion $itemPromotion)
    {
        return response()->json(ItemPromotion::find($itemPromotionID));
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\ItemPromotion  $itemPromotion
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, ItemPromotion $itemPromotion)
    {
        //
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\ItemPromotion  $itemPromotion
    * @return \Illuminate\Http\Response
    */
    public function destroy(ItemPromotion $itemPromotion)
    {

        $itemPromotion->delete();
        return response()->json('Ok', 200);



    }
}
