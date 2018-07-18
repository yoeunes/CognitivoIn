<?php

namespace App\Http\Controllers\Api;

use App\Item;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AccountMovementController;
use Illuminate\Http\Request;
use DB;
use Swap\Laravel\Facades\Swap;

class ItemController extends Controller
{

  public function Upload(Request $request,Profile $profile)
  {
    $data = collect();

      if ($request->all() != [])
      {
          $data = collect($request->all());
      }

      $collection = json_decode($data->toJson());

      foreach ($collection as $key => $data)
      {
          $item = Item::where('id', $data->id)->first() ?? new Item();
          $item->profile_id = $profile->id;
          $item->sku = $data->sku;
          $item->name = $data->name;
          $item->short_description = $data->short_description;
          $item->long_description = $data->long_description;
          $item->unit_price = $data->unit_price;
          $item->currency = $data->currency ?? $profile->currency;
          $item->item_id = $data->item_id;
          $item->vat_id = $data->vat_id;
          $item->is_stockable = $data->is_stockable;
          $item->is_active = $data->is_active == 'on' ? true : false;

          $item->save();
      }
  }

  public function Download(Request $request,Profile $profile)
  {
    $items =Item::where('profile_id',$profile->id)
    ->get();
    return response()->json($items);
  }


}
