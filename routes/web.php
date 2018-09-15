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

Route::get('/market', 'HomeController@indexMarket')->name('market.index');
Route::get('/shop/{profile}', 'HomeController@indexStores')->name('shop.show');
Route::get('/shop/{profile}/item/{item}', 'ItemController@indexStores')->name('shop.item.show');

Route::group(['middleware' => 'auth'], function ()
{
    Route::get('/settings','SettingController@index')->name('settings');
    Route::get('/{profile?}', 'HomeController@index')->name('home');

    Route::resources([
        'inbox' => 'MessageController',
        'profile' => 'ProfileController'
    ]);

    Route::prefix('/dashboard/{profile}')->group(function ()
    {
        Route::get('/{url}', 'NavigationController@index')->where('any', '.*');
    });

    Route::prefix('reports')->group(function ()
    {
        Route::get('/index', 'ReportController@index')->name('reports.index');

        Route::get('opportunities/{profile}/{strDate}/{endDate}', 'ReportController@opportunity')->name('reports.opportunities');
        Route::get('opportunitiesTask/{profile}/{strDate}/{endDate}', 'ReportController@opportunityTask')->name('reports.opportunitiesTask');
    });
});
