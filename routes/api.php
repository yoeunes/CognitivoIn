<?php

// use Illuminate\Http\Request;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['middleware' => 'auth:api'], function ()
{
    Route::resource('profile', 'ProfileController');

    Route::prefix('{profile}')->group(function ()
    {
        Route::prefix('back-office')->group(function ()
        {
            Route::resources([
                'customers' => 'CustomerController',
                'suppliers' => 'SupplierController',
                'items' => 'ItemController',
                'pipelines' => 'PipelineController',
                'opportunities' => 'OpportunityController',
                'orders' => 'OrderController',
                'account-payables' => 'AccountPayableController',
                'account-receivables' => 'AccountReceivableController',
                // 'profile' => 'ProfileController'
            ]);

            Route::prefix('list/{skip}')->group(function ()
            {
                Route::get('customers', 'CustomerController@index');
                Route::get('suppliers', 'SupplierController@index');
                Route::get('items', 'ItemController@index');
            });

            //Searches using ElasticSearch Server for index based search results.
            Route::prefix('search')->group(function ()
            {
                Route::get('customers/{query}', 'CustomerController@search');
                Route::get('suppliers/{query}', 'SupplierController@search');
                Route::get('items/{query}', 'ItemController@search');
                Route::get('opportunities/{query}', 'OpportunityController@search');
                Route::get('orders/{query}', 'OrderController@search');
            });

            //Annull movements on specific modules
            Route::prefix('annull')->group(function ()
            {
                Route::get('orders/{id}', 'OrderController@annull');
                Route::get('account-payables/{id}', 'AccountPayableController@annull');
                Route::get('account-receivables/{id}', 'AccountReceivableController@annull');
            });


            Route::get('list-currency', 'Api\ApiController@list_currency');

        });

// TODO remove all these methods
        Route::post('PaymentReceive', 'AccountMovementController@store');
        Route::post('Anull', 'AccountMovementController@annull');
        Route::post('PaymentDue', 'Api\AccountController@get_CustomerSchedual');
        Route::post('ApproveSales', 'Api\AccountController@ApproveSales');

        Route::post('syncitem', 'Api\ItemController@syncItems');
        Route::post('synccustomer', 'Api\CustomerController@syncCustomer');

        Route::post('synctransaction', 'Api\TransactionController@uploadOrder');
    });
});

Route::get('getCompanys/{slug}', 'ProfileController@get_companys');
Route::get('login/{email}/{password}', 'Auth\SocialAuthController@Login');
Route::get('getCustomers/{profile}', 'CustomerController@getAllCustomer');
