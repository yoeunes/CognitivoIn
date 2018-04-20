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
{});

  Route::prefix('{profile}')->group(function ()
  {
    Route::get('back-office/list-items/{location_slug?}', 'Api\ApiController@list_items');
    Route::get('back-office/list-customers', 'Api\ApiController@list_customers');
    Route::post('back-office/customers', 'Api\ApiController@customers');
    Route::get('back-office/list-suppliers', 'Api\ApiController@list_suppliers');
    Route::get('back-office/list-currency', 'Api\ApiController@list_currency');
    Route::get('back-office/list-account-receivables/{customer_ID}', 'Api\ApiController@list_account_receivables');
    Route::get('back-office/list-account-payables/{supplier_id}', 'Api\ApiController@list_account_payables');


  });
  // group by slug
  // back-office/list-items/{location_slug?} //with stock and price list
  // back-office/list-customers
  // back-office/list-suppliers
  // back-office/list-currrency
  // back-office/list-account-receivables/{customer_ID}
  // back-office/list-account-payables/{supplier_ID}

  // back-office/make-sales //Note: Multiple
  // back-office/receive-payment //Note: Multiple
  // back-office/make-payment //Note: Multiple


//  Route::get('PaymentDue/{slug}/{type}/{partnerName}/{partnerTaxID}', 'SchedualsController@PaymentDue');
Route::post('PaymentDue/{profile}', 'SchedualsController@PaymentDue');
Route::post('ReceivePayment/{profile}', 'SchedualsController@ReceivePayment');
Route::post('Anull', 'AccountMovementController@Anull');
