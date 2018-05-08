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
  public function list_items(Profile $profile,$skip)
  {
    $items = Item::GetItems($profile->id)
    ->skip($skip)
    ->take(100)
    ->get();

    return response()->json($items);
  }

  public function list_itemsByID(Profile $profile,$id)
  {
    $items =Item::GetItems($profile->id)
    ->where('id',$id)
    ->get();

    return response()->json($items);
  }

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

    $processedItems = new Collection();


    foreach ($collection as $element)
    {

      $processedItems->push($this->createOrUpdate_Item($element));
      $counter += 1;
    }

    //Return CloudID back to Client Application for processing.
    return response()->json($processedItems, 200);
  }

  // TODO: Use Elastic Search for this function to improve velocity and usage.
  public function search(Profile $profile, $query)
  {
    return Item::search($query)->where('profile_id', $profile->id)->get();
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

  
    //vat id?
    $item->unit_cost = $data->unit_cost;
    $item->unit_price = $data->unit_price;
    $item->currency = $data->currency_code;
    //$item->ref_id = $data->ref_id;
    $item->save();

    $data->cloud_id = $item->id;

    return $item;
  }
}