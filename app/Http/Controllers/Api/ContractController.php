<?php

namespace App\Http\Controllers\Api;

use App\Contract;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AccountMovementController;
use Illuminate\Http\Request;
use DB;
use Swap\Laravel\Facades\Swap;

class ContractController extends Controller
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
      $contract = Contract::where('id',$data->id)->first() ?? new Contract();

      $contract->name =$data->name;
      $contract->profile_id = $profile->id;
      $contract->country = $profile->country;
      $contract->save();

      $totalPercent = 0;
      $details = collect($data>details);

      foreach ($details as $row)
      {
        $detail = ContractDetail::where('id', $row['id'])->first()
        ?? new ContractDetail();
        $detail->contract_id = $contract->id;
        $detail->percent =$row['percent'];
        $detail->offset = $row['offset'];
        $detail->save();

        $totalPercent += $detail->percent;
      }
      //this code adds the remaining balance to the end.
      $contract_detail=$contract->details()->orderBy('id', 'DESC')->first();
      if ($totalPercent < 1 && isset($contract_detail))
      {
        $detail = $contract->details()->orderBy('id', 'DESC')->first();
        $detail->percent = $detail->percent + (1 - $totalPercent);
        $detail->save();
      }
    }
  }

  public function Download(Request $request,Profile $profile)
  {
    $contracts =Contract::where('profile_id',$profile->id)->
    with('detail')
    ->get();
    return response()->json($contracts);
  }


}
