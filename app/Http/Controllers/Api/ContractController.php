<?php

namespace App\Http\Controllers\Api;

use App\Profile;
use App\Contract;
use App\ContractDetail;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AccountMovementController;
use Illuminate\Http\Request;
use DB;
use Swap\Laravel\Facades\Swap;

class ContractController extends Controller
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

  public function Upload(Request $request,Profile $profile)
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
      $contract = Contract::where('id',$data->cloud_id)->first() ?? new Contract();
      if ($contract->updated_at < $this->convert_date($data->updated_at))
      {
        $contract->ref_id=$data->local_id;
        $contract->name =$data->name;
        $contract->profile_id = $profile->id;
        $contract->country = $profile->country;
        $contract->save();

        $totalPercent = 0;
        $details = collect($data->details);

        foreach ($details as $row)
        {
          $detail = ContractDetail::where('percent', $row->percent)->first()
          ?? new ContractDetail();
          $detail->contract_id = $contract->id;
          $detail->percent =$row->percent;
          $detail->offset = $row->offset;
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
        $returnData[$i]=$contract;
      }
      else if ($contract->updated_at > $this->convert_date($data->updated_at))
      {
        $returnData[$i]=$contract;
        $returnData[$i]->ref_id=$data->local_id;
      }

      $i=$i+1;

    }
    return response()->json($returnData,200);
  }

  public function Download(Request $request,Profile $profile)
  {
    $contracts =Contract::where('profile_id',$profile->id)->
    with('details')
    ->get();
    return response()->json($contracts);
  }


}
