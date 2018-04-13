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
    Route::prefix('back-office')->group(function ()
    {
        Route::get('dashboard', 'BackOfficeController@showDashboard');
        Route::get('profiles', 'BackOfficeController@showProfile');
        Route::get('stores', 'BackOfficeController@showStore');
        Route::get('items', 'BackOfficeController@showItems');

        Route::prefix('sales')->group(function ()
        {
            Route::get('stores', 'BackOfficeController@showStore');
            Route::get('items', 'BackOfficeController@showItems');
            Route::get('stores', 'BackOfficeController@showStore');
            Route::get('items', 'BackOfficeController@showItems');
        });

        Route::prefix('purchase')->group(function ()
        {

        });

        Route::prefix('stock')->group(function ()
        {

        });

        Route::prefix('finance')->group(function ()
        {

        });
    });
});


//  Route::get('PaymentDue/{slug}/{type}/{partnerName}/{partnerTaxID}', 'SchedualsController@PaymentDue');
Route::get('PaymentDue/{slug}', 'SchedualsController@PaymentDue');
Route::post('ReceivePayment/{slug}', 'AccountMovementController@ReceivePayment');
Route::post('Anull', 'AccountMovementController@Anull');
