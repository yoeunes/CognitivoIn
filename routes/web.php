<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/{profile?}', 'HomeController@index')->name('home');
Route::get('/market', 'HomeController@indexMarket')->name('market.index');
Route::get('/shop/{profile}', 'HomeController@indexStores')->name('shop.show');
Route::get('/shop/{profile}/item/{item}', 'ItemController@indexStores')->name('shop.item.show');

Route::group(['middleware' => 'auth'], function ()
{
    Route::resources([
        //'inbox' => 'MessageController',
        'profile' => 'ProfileController'
    ]);

    Route::prefix('back-office/{profile}')->group(function ()
    {
        Route::get('{url}', 'NavigationController@index')->where('any', '.*');
    });
});
Route::prefix('{profile}')->group(function ()
{
    Route::prefix('back-office')->group(function ()
    {
        Route::post('customers/store', 'CustomerController@store');
        Route::post('opportunities/{opportunity}/tasks/checked', 'OpportunityTaskController@taskChecked');

        Route::prefix('list')->group(function ()
        {
            Route::get('locations/{filterBy}', 'LocationController@index');
            Route::get('vats/{filterBy}', 'VatController@index');
            Route::get('contracts/{filterBy}', 'ContractController@index');
            Route::get('customers/{filterBy}', 'CustomerController@index');
            Route::get('suppliers/{filterBy}', 'SupplierController@index');
            Route::get('items/{filterBy}', 'ItemController@index');
            Route::get('followers/{filterBy}', 'FollowerController@index');
            Route::get('pipelines/{filterBy}', 'PipelineController@index');
            Route::get('opportunities/{filterBy}', 'OpportunityController@index');
            Route::get('orders/{filterBy}', 'OrderController@index');
          //  Route::get('accounts/{filterBy}', 'AccountController@index');
            Route::get('account-payables/{filterBy}', 'AccountPayableController@index');
            Route::get('account-receivables/{filterBy}', 'AccountReceivableController@index');
            Route::get('account-movement/{filterBy}', 'AccountMovementController@index');
        });

        //Searches using ElasticSearch Server for index based search results.
        Route::prefix('search')->group(function ()
        {
            Route::get('profiles/{query}', 'ProfileController@search');
            Route::get('customers/{query}', 'CustomerController@search');
            Route::get('suppliers/{query}', 'SupplierController@search');
            Route::get('items/{query}', 'ItemController@search');

            //TODO
            Route::get('opportunities/{query}', 'OpportunityController@search');
            Route::get('orders/{query}', 'OrderController@search');
            Route::get('account-receivables/{query}', 'AccountReceivableController@search');
            Route::get('account-payables/{query}', 'AccountPayableController@search');

            //Search Account Receivables by Customer
            Route::post('account-receivables', 'AccountReceivableController@search');
        });

        //Annull movements on specific modules
        Route::prefix('transact')->group(function ()
        {
            Route::post('sales', 'Api\TransactionController@SalesInvoice_createApprove');
            Route::post('opportunities', 'OpportunityController@approve');

            //TODO, change name to proper english. recEIved instead of recIEved
            Route::post('payment-made', 'AccountPayableController@store');
            Route::post('payment-received', 'AccountReceivableController@store');
        });

        //Annull movements on specific modules
        Route::prefix('revert')->group(function ()
        {
            Route::post('orders/{id}', 'OrderController@annul');
            Route::post('opportunities', 'OpportunityController@annul');

            //TODO
            Route::post('payment-made/{id}', 'AccountPayableController@annul');
            Route::post('payment-recieved/{id}', 'AccountReceivableController@annull');
        });

        Route::get('list-currency', 'Api\ApiController@list_currency');

        Route::resources([
            'locations' => 'LocationController',
            'vats' => 'VatController',
            'contracts' => 'ContractController',
            'followers' => 'FollowerController',
            'customers' => 'CustomerController',
            'suppliers' => 'SupplierController',
            'items' => 'ItemController',
            'pipelines' => 'PipelineController',
            'pipeline-stages' => 'PipelineStageController',
            'opportunities' => 'OpportunityController',
            'opportunities/{id}/tasks' => 'OpportunityTaskController',
            'opportunities/{id}/members' => 'OpportunityMemberController',
            'opportunities/{id}/items' => 'CartController',
            'orders' => 'OrderController',
            //'accounts' => 'AccountController',
            'account-payables' => 'AccountPayableController',
            'account-receivables' => 'AccountReceivableController',
            'account-movement' => 'AccountMovementController'
        ]);
    });

    Route::post('AmountFromContract', 'Api\AccountController@AmountFromContract');
    Route::post('SentReceipt', 'EmailController@sentemail');
});
// Route::get('/js/lang.js', function () {
//     $strings = Cache::rememberForever('lang.js', function () {
//         $lang = config('app.locale');
//
//         $files   = glob(resource_path('lang/' . $lang . '/*.php'));
//         $strings = [];
//
//         foreach ($files as $file) {
//             $name           = basename($file, '.php');
//             $strings[$name] = require $file;
//         }
//
//         return $strings;
//     });
//
//     header('Content-Type: text/javascript');
//     echo('window.i18n = ' . json_encode($strings) . ';');
//     exit();
// })->name('assets.lang');
//
// Route::get('js/lang-{locale}.js', function ($locale) {
//     // config('app.locales') gives all supported locales
//     if (!array_key_exists($locale, config('app.locales'))) {
//         $locale = config('app.fallback_locale');
//     }
//
//     // Add locale to the cache key
//     $json = \Cache::rememberForever("lang-{$locale}.js", function () use ($locale) {
//         ///...
//         return $data;
//     });
//
//     $contents = 'window.i18n = ' . json_encode($json, config('app.debug', false) ? JSON_PRETTY_PRINT : 0) . ';';
//     $response = \Response::make($contents, 200);
//     $response->header('Content-Type', 'application/javascript');
//
//     return $response;
// });
