<?php

use Illuminate\Http\Request;

/*

|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'auth:api'], function ()
{

});


//  Route::get('PaymentDue/{slug}/{type}/{partnerName}/{partnerTaxID}', 'SchedualsController@PaymentDue');
Route::get('PaymentDue/{slug}', 'SchedualsController@PaymentDue');
Route::post('ReceivePayment/{slug}', 'AccountMovementController@ReceivePayment');
Route::post('Anull', 'AccountMovementController@Anull');
