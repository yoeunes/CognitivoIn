<?php

namespace App\Http\Controllers\Api;

use App\Profile;
use Carbon\Carbon;
use App\Http\Resources\APICompany;
use Illuminate\Http\Request;
use DB;
use Swap\Laravel\Facades\Swap;

class CompanyController extends Controller
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
      $company = Profile::where('slug',$data->slugCognitivo)->first() ?? new Profile();
      if ($company->updated_at < $this->convert_date($data->updatedAt))
      {

        $company->name = $request->name;
        $company->alias = $request->alias;
        $company->address = $request->address;
        $company->taxid = $request->taxID;
        $company->currency = $request->currencyCode;
        $company->country = $request->country ?? 'PYG';
        $company->type = 2;
        $company->save();

      }

    }
    return response()->json('sucess',200);
  }

  public function Download(Request $request,Profile $profile)
  {
    return Company::collection(Profile::get());

  }


}
