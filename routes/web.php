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
// Route::get('/{profile}', 'ProfileController@show')->name('profile');

Route::group(['middleware' => 'auth'], function ()
{
  Route::post('create', 'ProfileController@index')->name('profile.create');

  Route::resources([
    'inbox' => 'MessageController',
    'profile' => 'ProfileController'
  ]);

  // Route::get('/{profile?}', 'HomeController@index');
  Route::get('dashboard', 'BackOfficeController@index')->name('dashboard');
  Route::get('profile', 'BackOfficeController@indexProfile');
  Route::get('locations', 'BackOfficeController@indexStore');

  Route::get('selectitems', 'BackOfficeController@indexItems');

  Route::prefix('back-office/{profile}')->group(function ()
  {
    Route::prefix('sales')->group(function ()
    {
      Route::get('dashboard', 'BackOfficeController@dashboardSales');
      Route::resources([
        'customers' => 'CustomerController',
        'opportunities' => 'OpportunityController',
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
    });

    Route::prefix('purchase')->group(function ()
    {
      Route::get('dashboard', 'BackOfficeController@dashboardPurchase');
      Route::resources([
        'suppliers' => 'BackOfficeSupplierController',
        'orders' => 'BackOfficePurchaseController',
      ]);
    });

    Route::prefix('stock')->group(function ()
    {
      Route::get('dashboard', 'BackOfficeController@dashboardStock');
      Route::resources([
        'movements' => 'BackOfficeStockMovementController',
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
