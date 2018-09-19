<?php

namespace App\Http\Controllers\Api;

use App\Profile;
use App\Item;
use Carbon\Carbon;
use App\Http\Resources\APIItem;
use App\Http\Controllers\Controller;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AccountMovementController;
use Illuminate\Http\Request;
use DB;
use Swap\Laravel\Facades\Swap;

class ItemController extends Controller
{
  public function convert_date($date)
  {
    return Carbon::createFromFormat('Y-m-d H:i:s', $date->date);
  }
  public function search(Profile $profile, $query)
  {
    //TODO add a search result for items
    if (strlen($query) > 3)
    {
      // code...
    }
  }

  public function CreateItem($data,Profile $profile)
  {
    $str=$data['name'];
    $item = new Item();
    $item->profile_id = $profile->id;
    $item->sku = $data['code'];
    $item->name = $str.substring(0, 100) + '...';
    $item->short_description = $data['comment']??'';
    $item->unit_price = $data['unit_price']??0;
    $item->currency = $data['currency_code'] ?? $profile->currency;
    $item->ref_id=$data['local_id'];
    $item->save();
    return $item;

  }

  public function sync(Request $request, Profile $profile)
  {
    $data=$this->upload($request, $profile);

    return response()->json($data->original,200);
  }

  public function upload(Request $request, Profile $profile)
  {

    $data = collect();
    $itemData = array();
    if ($request->all() != [])
    {
      $data = collect($request->all());
    }

    $collection = json_decode($data->toJson());



    $i=0;
    foreach ($collection as $data)
    {

      $item = Item::where('id', $data->cloudId)->first() ?? new Item();
      if ($item->updated_at < $this->convert_date($data->updatedAt))
      {

        $item->profile_id = $profile->id;
        $item->ref_id=$data->localId;
        $item->sku = $data->sku;
        $item->name = str_limit($data->name,100,' (...) ');
        $item->unit_price = $data->price;
        $item->currency = $data->currencyCode ?? $profile->currencyCode;
        $item->save();


      }
      $itemData[$i] = $item->id;
      $i=$i+1;

    }
    $itemData=APIItem::collection(Item::whereIn('id',$itemData)->get());
    return response()->json($itemData,200);

  }

  public function download(Request $request,Profile $profile)
  {

    //Return a HTTP Resource from Laravel.
    return  APIItem::collection(Item::where('profile_id',$profile->id)
    ->get());


  }
}
