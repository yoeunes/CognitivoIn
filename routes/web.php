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

Route::group(['middleware' => 'auth'], function ()
{
    Route::resources([
        'inbox' => 'MessageController',
        'profile' => 'ProfileController'
    ]);

    Route::get('dashboard', 'BackOfficeController@index')->name('dashboard');
    Route::get('profile', 'BackOfficeController@indexProfile');
    Route::get('locations', 'BackOfficeController@indexStore');

    Route::get('selectitems', 'BackOfficeController@indexItems');

    Route::prefix('back-office/{profile}')->group(function ()
    {
        //TODO: Remove this from here and check with API.php
        Route::prefix('search')->group(function ()
        {
            Route::get('profiles/{query}', 'ProfileController@search');
            Route::get('customers/{query}', 'CustomerController@search');
            Route::get('items/{query}', 'ItemController@search');
        });

        Route::post('update', 'ProfileController@update')->name('profile.update');

        Route::prefix('sales')->group(function ()
        {
            Route::get('dashboard', 'BackOfficeController@dashboardSales');

            Route::resources([
                'customers' => 'CustomerController',
                'opportunities' => 'OpportunityController',
                'opportunities/{opportunity}/tasks' => 'OpportunityTaskController',
                'promotions' => 'ItemPromotionController',
                'followers' => 'FollowerController',
                'orders' => 'OrderController',
                'pipelines' => 'PipelineController',
                'pipelinestages' => 'PipelineStageController',
                'items' => 'ItemController',
                'locations' => 'LocationController',
                'vats' => 'VatController',
                'vatdetail' => 'VatDetailController',
                'contracts' => 'ContractController',
                'contractdetail' => 'ContractDetailController'
            ]);

            Route::post('opportunities/{opportunity}/tasks/checked', 'OpportunityTaskController@taskChecked');
        });

        Route::prefix('purchase')->group(function ()
        {
            Route::get('dashboard', 'BackOfficeController@dashboardPurchase');
            Route::resources([
                'suppliers' => 'SupplierController',
                'orders' => 'BackOfficePurchaseController',
            ]);
        });

        Route::prefix('stock')->group(function ()
        {
            Route::get('dashboard', 'BackOfficeController@dashboardStock');
            Route::resources([
                'movements' => 'BackOfficeStockMovementController',
                'items' => 'ItemController',
            ]);
        });

        Route::prefix('finance')->group(function ()
        {
            Route::get('dashboard', 'BackOfficeController@dashboardFinance');
            Route::resources([
                'accounts' => 'BackOfficeAccountController',
                'account-receivables' => 'BackOfficeAccountReceivableController',
                'account-payables' => 'BackOfficeAccountPayableController',
                'account-movements' => 'BackOfficeAccountMovementController',
            ]);
        });
    });
});
