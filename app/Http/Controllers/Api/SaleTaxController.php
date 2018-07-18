<?php

namespace App\Http\Controllers\Api;

use App\Vat;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AccountMovementController;
use Illuminate\Http\Request;
use DB;
use Swap\Laravel\Facades\Swap;

class SaleTaxController extends Controller
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
      $vat =  $data->id == 0 ? new Vat() : Vat::where('id', $data->id)->first();
      $vat->profile_id = $profile->id;


      $vat->name = $data->name;
      $vat->country ='PRY';
      $vat->applied_on=1;


      $vat->save();

      $details = collect($data->details);

      foreach ($details as $row)
      {
        $detail = VatDetail::where('id', $row['id'])->first()
        ?? new VatDetail();
        $detail->vat_id = $vat->id;
        $detail->percent = $row['percent'];
        $detail->coefficient = $row['coefficient'];
        $detail->save();


      }

    }
  }

  public function Download(Request $request,Profile $profile)
  {
    $vats =Vat::where('profile_id',$profile->id)->
    with('detail')
    ->get();
    return response()->json($vats);
  }


}
