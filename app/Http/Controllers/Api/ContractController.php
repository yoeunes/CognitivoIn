<?php

namespace App\Http\Controllers\Api;

use App\Profile;
use App\Contract;
use App\ContractDetail;
use Carbon\Carbon;
use App\Http\Resources\APIContractResource;
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
    $data=$this->download($request, $profile);
    return response()->json($data,200);
  }

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
      $contract = Contract::where('id',$data->cloudId)->first() ?? new Contract();
      if ($contract->updated_at < $this->convert_date($data->updatedAt))
      {
        $contract->ref_id=$data->localId;
        $contract->name =$data->name;
        $contract->profile_id = $profile->id;
        $contract->country = $profile->country;
        $contract->save();

        $totalPercent = 0;
        $details = collect($data->details);

        foreach ($details as $row)
        {
          $detail = ContractDetail::where('percent', $row->percent)
          ->where('contract_id', $contract->id)
          ->first()
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

      }

    }
    return response()->json('sucess',200);
  }

  public function Download(Request $request,Profile $profile)
  {
    return APIContractResource::collection(Contract::where('profile_id',$profile->id)->
    with('details')
    ->get());

  }


}
