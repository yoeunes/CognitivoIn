<?php

namespace App\Http\Controllers\Api;

use App\Profile;
use App\Vat;
use App\VatDetail;
use Carbon\Carbon;
use DateTime;
use App\Http\Resources\APIVat;
use App\Http\Controllers\Controller;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AccountMovementController;
use Illuminate\Http\Request;
use Swap\Laravel\Facades\Swap;
use DB;

class SaleTaxController extends Controller
{

  public function sync(Request $request, Profile $profile)
  {
    $this->upload($request, $profile);
    $data=$this->download($request, $profile);
    return response()->json($data,200);
  }

  public function upload(Request $request,Profile $profile)
  {
    $data = collect();

    if ($request->all() != [])
    {
      $data = collect($request->all());
    }

    $collection = json_decode($data->toJson());

    foreach ($collection as $key => $data)
    {
      $vat = Vat::where('id', $data->cloudId)->first() ?? new Vat();
      if ($vat->updated_at < $this->convert_date($data->updatedAt))
      {

        $vat->ref_id=$data->localId;
        $vat->profile_id = $profile->id;
        $vat->name = $data->name;
        $vat->country = $data->country ?? $profile->country;
        $vat->applied_on = 1;
        $vat->save();

        $details = collect($data->details);

        foreach ($details as $row)
        {
          //Do not do like this. Just use coefficients to get the difference.
          $detail = VatDetail::where('coefficient', $row->coefficient)
          ->where('vat_id', $vat->id)
          ->first() ?? new VatDetail();

          $detail->vat_id = $vat->id;
          $detail->percent = $row->percentage;
          $detail->coefficient = $row->coefficient;
          $detail->save();

        }
      }

    }
    return response()->json('Sucess',200);
  }
  public function convert_date($date)
  {
    return Carbon::createFromFormat('Y-m-d H:i:s', $date);
  }

  public function download(Request $request,Profile $profile)
  {
    return APIVat::collection(
      Vat::with('details')->get());

    //return response()->json($vats);
  }
}
