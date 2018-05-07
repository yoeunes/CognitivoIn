<?php

namespace App\Http\Controllers\Api;

use App\Item;
use App\Relationship;
use App\Profile;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SyncController extends Controller
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
        foreach ($collection as $key => $element)
        {
            $this->createOrUpdate_Item($element);
            $counter += 1;
        }

        return response()->json('Sucess, ' . $counter . ' records updated.');
    }
    public function createOrUpdate_Item($data)
    {
        $profile = request()->route('profile');

        $item = Item::GetItems($profile)->where('name', $data->name)->where('sku', $data->code)->first();

        if (!isset($item))
        {
            $item = new Item();
            $item->profile_id = $profile->id;

            $item->name = mb_strimwidth($data->name, 0, 187, '...');
            $item->sku = $data->code;
            $item->short_description = $data->comment;
            $item->unit_price = $data->unit_price;

            $item->currency_id =$data->currency_code;
            $item->save();
            $data->cloud_id=$item->id;
        }

        return $item;
    }










}
