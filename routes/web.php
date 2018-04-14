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

Route::get('/', function () {
    return view('welcome');
});
Route::group(['middleware' => 'auth'], function ()
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
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
