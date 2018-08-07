<?php

namespace App\Http\Controllers\Api;

use App\Profile;
use App\Vat;
use App\VatDetail;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AccountMovementController;
use Illuminate\Http\Request;
use Swap\Laravel\Facades\Swap;

class SaleTaxController extends Controller
{

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
      $vat = Vat::where('id', $data->cloud_id)->first() ?? new Vat();
      if ($vat->updated_at < $data->updated_at)
      {
        $vat->ref_id=$data->local_id;
        $vat->profile_id = $profile->id;
        $vat->name = $data->name;
        $vat->country = $data->country ?? $profile->country;
        $vat->applied_on = 1;
        $vat->save();

        $details = collect($data->details);

        foreach ($details as $row)
        {
          //Do not do like this. Just use coefficients to get the difference.
          $detail = VatDetail::where('id', $row->id)->first() ?? new VatDetail();
          $detail->vat_id = $vat->id;
          $detail->percent = $row->percent;
          $detail->coefficient = $row->coefficient;
          $detail->save();
          $returnData[$i]=$vat;
        }
      }
      else if ($item->updated_at > $data->updated_at)
      {
        $returnData[$i]=$vat;
      }

      $i=$i+1;

    }
    return response()->json($returnData,200);
  }

  public function download(Request $request,Profile $profile)
  {
    $vats = Vat::where('profile_id',$profile->id)
    ->with('detail')
    ->get();

    return response()->json($vats);
  }
}
