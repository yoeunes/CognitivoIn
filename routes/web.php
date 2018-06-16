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
        'inbox' => 'MessageController',
        'profile' => 'ProfileController'
    ]);

    Route::prefix('back-office/{profile}')->group(function ()
    {
        Route::get('{url}', 'NavigationController@index')->where('any', '.*');
    });
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
