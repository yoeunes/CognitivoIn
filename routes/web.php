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

Route::get('/', 'HomeController@index')->name('market');
Route::get('/shops', 'HomeController@indexStores')->name('shops.index');
Route::get('/shop/{profile}', 'HomeController@indexStores')->name('shops.show');
Route::get('/{profile}', 'ProfileController@show')->name('profile');

Route::group(['middleware' => 'auth'], function ()
{
    Route::post('create', 'ProfileController@index')->name('profile.create');

    Route::resources([
        'inbox' => 'MessageController',
        'profile' => 'ProfileController'
    ]);

    Route::prefix('back-office')->group(function ()
    {
        Route::get('/', 'BackOffice.Controller@index');
        Route::get('dashboard', 'BackOffice.Controller@index');
        Route::get('profile', 'BackOffice.Controller@indexProfile');
        Route::get('locations', 'BackOfficeController@indexStore');
        Route::get('items', 'BackOfficeController@indexItems');

        Route::prefix('sales')->group(function ()
        {
            Route::get('dashboard', 'BackOffice.Controller@dashboardSales');
            Route::resources([
                'customers' => 'BackOffice.CustomerController',
                'opportunities' => 'BackOffice.OpportunityController',
                'orders' => 'BackOffice.OrderController',
            ]);
        });

        Route::prefix('purchase')->group(function ()
        {
            Route::get('dashboard', 'BackOffice.Controller@dashboardPurchase');
            Route::resources([
                'suppliers' => 'BackOffice.SupplierController',
                'orders' => 'BackOffice.PurchaseController',
            ]);
        });

        Route::prefix('stock')->group(function ()
        {
            Route::get('dashboard', 'BackOffice.Controller@dashboardStock');
            Route::resources([
                'movements' => 'BackOffice.StockMovementController',
            ]);
        });

        Route::prefix('finance')->group(function ()
        {
            Route::get('dashboard', 'BackOffice.Controller@dashboardFinance');
            Route::resources([
                'accounts' => 'BackOffice.AccountController',
                'account-receivables' => 'BackOffice.AccountReceivableController',
                'account-payables' => 'BackOffice.AccountPayableController',
                'account-movements' => 'BackOffice.AccountMovementController',
            ]);
        });
    });
});

Route::resource('profile', 'ProfileController');
Route::get('/{profile?}', 'HomeController@index')->name('home');
