<?php

namespace App\Http\Controllers\Api;

use App\Item;
use App\Relationship;
use App\Profile;
use App\Currency;
use App\Scheduals;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function list_items(Profile $profile,$location_slug)
    {
        // if (isset($location_slug)) {
        //     $items =Item::GetItems($profile->id)
        //     ->join('item_movements', 'items.id', 'item_movements.item_id')
        //     ->where('location_id',$location_slug)
        //     ->groupBy('item_movements.item_id')
        //     ->get();
        // }
        // else {
    
            $items =Item::GetItems($profile->id)
            ->get();
    //    }

        return response()->json($items);
    }
    public function list_customers(Profile $profile)
    {

        $customers = Relationship::GetCustomers()->get();

        return response()->json($customers);
    }
    public function list_suppliers(Profile $profile)
    {
        $suppliers = Relationship::GetSuppliers()->get();

        return response()->json($suppliers);
    }
    public function list_currency(Profile $profile)
    {
        $suppliers = Currency::get();

        return response()->json($suppliers);
    }
    public function list_account_receivables(Profile $profile,$customer_ID)
    {
        $suppliers = Scheduals::
        Join('relationships','relationships.id','=','scheduals.relationship_id')
        ->where('relationships.customer_id',$customer_ID)
        ->get();

        return response()->json($suppliers);
    }
    public function list_account_payables(Profile $profile,$supplier_ID)
    {
        $suppliers = Scheduals::
        Join('relationships','relationships.id','=','scheduals.relationship_id')
        ->where('relationships.supplier_id',$supplier_ID)
        ->get();

        return response()->json($suppliers);
    }









}
