<?php

namespace App\Http\Controllers\Api;

use App\Profile;
use App\VatDetail;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Http\Controllers\AccountMovementController;
use Illuminate\Http\Request;
use DB;
use Swap\Laravel\Facades\Swap;

class PaymentController extends Controller
{


    public function upload(Request $request, Profile $profile)
    {

        $accountMovement = new AccountMovementController();
        $accountMovement->makePayment($request);
        $vatDetail = VatDetail::leftjoin('order_details', 'order_details.vat_id', 'vat_details.vat_id')
        ->where('order_id', $order->id)
        ->select(DB::raw('CONCAT(round(max(coefficient),2) * 100, "%" )as coefficient'),
        DB::raw('round(sum(percent * coefficient * unit_price * quantity),2) as value')
        )
        ->groupBy('coefficient')
        ->get();

        $data2 = [];
        $data2[] = [
            'date' => $order->date,
            'Detail'=> $vatDetail
        ];


    }

}
