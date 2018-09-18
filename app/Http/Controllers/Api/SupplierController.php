<?php

namespace App\Http\Controllers\Api;

use App\Profile;
use App\Relationship;
use Carbon\Carbon;
use App\Http\Resources\Supplier;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Swap\Laravel\Facades\Swap;

class SupplierController extends Controller
{

  public function convert_date($date)
  {
      return Carbon::createFromFormat('Y-m-d H:i:s', $date);
  }

  public function search(Profile $profile, $query)
  {
      //TODO add a search result for items
      if (strlen($query) > 3)
      {
          // code...
      }
  }

  public function CreateCustomer($data,Profile $profile)
  {
      $relationship = new Relationship();
      $relationship->customer_id = $profile->id;
      $relationship->customer_accepted = true;

      $relationship->supplier_taxid = $data->taxID;
      $relationship->supplier_alias = $data->alias;
      $relationship->supplier_address = $data->address;
      $relationship->supplier_telephone = $data->telephone;
      $relationship->supplier_email = $data->email;

      //$relationship->lead_time=$data->leadTime ;

      $relationship->save();
      return $relationship;
  }

  public function sync(Request $request, Profile $profile)
  {
      $data = $this->upload($request, $profile);
      return response()->json($data->original, 200);
  }

  public function upload(Request $request, Profile $profile)
  {
      $supplierData = array();
      $data = collect();

      if ($request->all() != [])
      {
          $data = collect($request->all());
      }

      $collection = json_decode($data->toJson());
      $i = 0;

      foreach ($collection as $key => $data)
      {
          $relationship = Relationship::where('id', $data->cloud_id)->first() ?? new Relationship();

          if ($relationship->updated_at < $this->convert_date($data->updated_at))
          {
              $relationship->ref_id = $data->local_id;
              $relationship->customer_id = $profile->id;
              $relationship->customer_accepted = true;

              $relationship->supplier_taxid = $request->taxid;
              $relationship->supplier_alias = $request->alias;
              $relationship->supplier_address = $request->address;
              $relationship->supplier_telephone = $request->telephone;
              $relationship->supplier_email = $request->email;
              $relationship->credit_limit = $request->credit_limit ?? 0;
              $relationship->contract_ref = $request->contract_ref ?? 0;

              $relationship->save();
          }

          $supplierData[$i] = $relationship->id;
          $i += $i;
      }

      //TODO: Fix Names, example => customer_taxid -> TaxID
      $supplierData = Supplier::collection(
          Relationship::whereIn('id', $customerData)
          ->select('customer_alias',
          'customer_taxid',
          'customer_geoloc',
          'customer_address',
          'customer_telephone',
          'customer_email',
          'credit_limit')
          ->get()
      );

      return response()->json($supplierData, 200);
  }

  public function download(Request $request,Profile $profile)
  {
      //Return a HTTP Resource from Laravel.
      return  Supplier::collection(Relationship::GetSuppliers()
      ->get());
  }
}
