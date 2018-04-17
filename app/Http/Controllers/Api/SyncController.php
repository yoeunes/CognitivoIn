<?php

namespace App\Http\Controllers\Api;

use App\Item;
use App\Relationship;
use App\Profile;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SyncController extends Controller
{
    public function convert_date($date)
    {
        $trans_date = $date;

        preg_match('/(\d{10})(\d{3})/', $date, $matches);

        $trans_date = Carbon::createFromTimestamp($matches[1]);
        // Log::info('fecha: '. $trans_date);
        return $trans_date;
    }

    public function syncItems(Request $request, Profile $profile)
    {

        $collection = collect();

        if ($request->all() != [])
        {
            $items = $request->all();
            $collection = collect($items);
        }

        $collection = json_decode($collection->toJson());
        $counter = 0;
        foreach ($collection as $key => $element)
        {
            $this->createOrUpdate_Item($element);
            $counter += 1;
        }

        return response()->json('Sucess, ' . $counter . ' records updated.');
    }

    public function syncCustomer(Request $request, Profile $profile)
    {

        $collection = collect();

        if ($request->all() !=  []) {
            $items = $request->all();
            $collection = collect($items);
        }

        $collection = json_decode($collection->toJson());

        foreach ($collection as $key  => $element)
        {
            $item = Relationship::GetCustomers()
            ->where('customer_alias', $element->name)
            ->where('customer_taxid', $element->govcode)
            ->first();

            if (!isset($item))
            {
                $relationship = new Relationship();

                $relationship->supplier_id = $profile->id;
                $relationship->supplier_accepted = true;

                $relationship->customer_taxid = $element->govcode;
                $relationship->customer_alias = $element->name;
                $relationship->customer_address = $element->address;
                $relationship->customer_telephone = $element->telephone;
                $relationship->customer_email = $element->email;
                $relationship->save();
            }
        }
        return response()->json('Sucess');
    }


}
