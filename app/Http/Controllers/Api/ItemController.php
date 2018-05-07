<?php

namespace App\Http\Controllers\Api;

use App\Item;
use App\Relationship;
use App\Profile;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ItemController extends Controller
{

    public function syncItems(Request $request, Profile $profile)
    {
        $collection = collect();

        if ($request->all() != [])
        {
            $items = $request->all();
            $collection = collect($items);
        }

        $collection = json_decode($collection->toJson());
        $counter = 0;

        foreach ($collection as $element)
        {
            //TODO make sure to add push or any function needed to add into array.
            $processedItems = collect($this->createOrUpdate_Item($element));
            $counter += 1;
        }

        //Return CloudID back to Client Application for processing.
        return response()->json($processedItems, 200);
    }

    // TODO: Use Elastic Search for this function to improve velocity and usage.
    public function search(Profile $profile, $query)
    {
        return Item::where('profile_id', $profile->id)
        ->where(function($q) use($query) {
            $q->where('name', $query)
            ->orWhere('sku', $query);
        })->get();
    }

    public function getItem($itemID)
    {
        return Item::find($itemID);
    }

    public function createOrUpdate_Item(Profile $profile, $data)
    {
        $profile = request()->route('profile');

        $item = Item::GetItems($profile)->where('id', $data->cloud_id)->first();

        if (isset($item) == false)
        {
            $item = Item::GetItems($profile)->where('name', $data->name)->where('sku', $data->code)->first() ?? new Item();
        }

        $item->profile_id = $profile->id;

        $item->name = mb_strimwidth($data->name, 0, 187, '...');
        $item->sku = $data->code;
        $item->long_description = $data->description;

        //cost?
        //vat id?

        $item->unit_price = $data->unit_price;
        $item->currency = $data->currency_code;
        //$item->ref_id = $data->ref_id;
        $item->save();

        $data->cloud_id = $item->id;

        return $item;
    }
}
