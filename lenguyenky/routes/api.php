<?php

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

use Illuminate\Support\Facades\Route;

Route::pattern('id', '[0-9]+');

Route::post('login', 'Api\Auth\LoginController@login')->name('login');

Route::group(['namespace' => 'Api', 'middleware' => 'jwt.auth'], function() {
    Route::apiResource('items', 'ItemController');
});
