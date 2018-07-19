<?php

namespace App\Http\Controllers\Api;

use App\Profile;
use App\Relationship;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Swap\Laravel\Facades\Swap;

class SupplierController extends Controller
{

    public function search(Profile $profile, $query)
    {
        //TODO add a search result for items
        if (strlen($query) > 3)
        {
            // code...
        }
    }

    public function sync(Request $request, Profile $profile)
    {
        $this->upload($request, $profile);
        $this->download($request, $profile);
    }

    public function upload(Request $request, Profile $profile)
    {
        $data = collect();

        if ($request->all() != [])
        {
            $data = collect($request->all());
        }

        $collection = json_decode($data->toJson());

        foreach ($collection as $key => $data)
        {
            $item = Item::where('id', $data->cloud_id)->first() ?? new Item();
            $item->profile_id = $profile->id;
            $item->sku = $data->sku;
            $item->name = $data->name;
            $item->short_description = $data->short_description;
            $item->long_description = $data->long_description;
            $item->unit_price = $data->unit_price;
            $item->currency = $data->currency ?? $profile->currency;

            //unless your vat_id is cloudID, you cannot use the same id as ERP.
            $item->vat_id = $data->vat_id;
            $item->is_stockable = $data->is_stockable;
            $item->is_active = $data->is_active == 'on' ? true : false;

            $item->save();
        }
    }

    public function download(Request $request,Profile $profile)
    {
        //Return a HTTP Resource from Laravel.
        $items = Item::where('profile_id',$profile->id)
        ->get();

        return response()->json($items);
    }
}
