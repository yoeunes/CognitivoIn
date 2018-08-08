<?php

namespace App\Http\Controllers\Api;

use App\Profile;
use App\Vat;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AccountMovementController;
use Illuminate\Http\Request;
use Swap\Laravel\Facades\Swap;

class PromotionController extends Controller
{
    public function convert_date($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date);
    }

    public function sync(Request $request, Profile $profile)
    {
        $this->upload($request, $profile);
        $this->download($request, $profile);
    }

    public function upload(Request $request,Profile $profile)
    {
        $data = collect();
        $i=0;
        $returnData = [];
        if ($request->all() != [])
        {
            $data = collect($request->all());
        }

        $collection = json_decode($data->toJson());

        foreach ($collection as $key => $data)
        {
            $itempromotion = ItemPromotion::where('id', $data->cloud_id)->first() ?? new ItemPromotion();
            if ($itempromotion->updated_at < $this->convert_date($data->updated_at))
            {
                $itempromotion->ref_id=$data->local_id;
                $promotion->type = $data->type;
                $promotion->input_id = $data->input_id;
                $promotion->output_id = $data->output_id;
                $promotion->input_value = $data->input_value;
                $promotion->output_value = $data->output_value;
                $promotion->start_date = $data->start_date;
                $promotion->end_date = $data->end_date;

                $promotion->save();
                $returnData[$i]=$promotion;
            }
            else if ($itempromotion->updated_at > $this->convert_date($data->updated_at))
            {
                $returnData[$i]=$promotion;
                $returnData[$i]->ref_id=$data->local_id;
            }

            $i=$i+1;
        }
        return response()->json($returnData,200);
    }

    public function download(Request $request,Profile $profile)
    {
        $promo = ItemPromotion::where('profile_id',$profile->id)
        ->get();

        return response()->json($promo);
    }
}
