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
Route::get('getCompanys', 'ProfileController@get_companys');
Route::get('login/{email}/{password}', 'Auth\SocialAuthController@Login');

Route::get('getCustomers/{profile}', 'CustomerController@getAllCustomer');


Route::prefix('{profile}')->group(function ()
{
    Route::prefix('back-office')->group(function ()
    {
        Route::resources([
            'movements' => 'BackOfficeStockMovementController',
        ]);

        Route::get('list-items/{skip}', 'ItemController@list_items');

        Route::get('get-items', 'ItemController@get_items');

        Route::get('list-items/by-id/{id}', 'ItemController@list_itemsByID');

        Route::get('list-customers/{skip}', 'CustomerController@list_customers');
        Route::get('list-customers/by-id/{id}', 'CustomerController@list_customersByID');

        Route::get('list-pipelines/{skip}', 'PipelineController@list_pipelines');
        Route::get('list-pipelines/all', 'PipelineController@get_pipelines');

        Route::get('list-orders/{skip}', 'OrderController@list_orders');
        Route::get('list-orders/by-id/{id}', 'OrderController@list_ordersByID');

        Route::get('list-pipelinestages/{skip}', 'PipelineStageController@list_pipelinestages');
        Route::get('list-stages/all', 'PipelineStageController@get_pipelinestages');
        Route::get('list-pipelinestages/by-id/{id}', 'PipelineStageController@list_pipelinestagesByID');

        Route::get('list-opportunities/{skip}', 'OpportunityController@list_opportunities');
        Route::get('list-opportunities/by-id/{id}', 'OpportunityController@list_opportunitiesByID');


        Route::get('list-suppliers', 'Api\ApiController@list_suppliers');
        Route::get('list-currency', 'Api\ApiController@list_currency');

        Route::get('list-account-receivables/{customer_ID}', 'Api\ApiController@list_account_receivables');
        Route::get('list-account-payables/{supplier_id}', 'Api\ApiController@list_account_payables');


    });
    Route::post('PaymentReceive', 'AccountMovementController@ReceivePayment');
    Route::post('customers', 'Api\RelationshipController@customers');
    Route::post('PaymentDue', 'Api\AccountController@get_CustomerSchedual');
    Route::post('ApproveSales', 'Api\AccountController@ApproveSales');

    Route::post('syncitem', 'Api\ItemController@syncItems');
    Route::post('synccustomer', 'Api\CustomerController@syncCustomer');

    Route::post('synctransaction', 'Api\TransactionController@uploadOrder');
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
Route::post('Anull', 'AccountMovementController@Anull');
