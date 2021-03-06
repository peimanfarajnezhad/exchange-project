<?php

use Illuminate\Support\Facades\Route;

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

Route::namespace('Api\V1')->group(function() {
    Route::prefix('v1')->group(function() {

        Route::prefix('prices')->group(function() {
            Route::get('', 'PriceController@list');
            Route::get('last', 'PriceController@last');
        });

        Route::prefix('orders')->group(function() {
            Route::get('{id}', 'OrderController@get');
            Route::post('', 'OrderController@create');
        });

    });
});
