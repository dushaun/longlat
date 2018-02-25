<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('property')->group(function () {
    Route::get('/', 'PropertyController@index');
    Route::post('/', 'PropertyController@store');
    Route::get('{property}', 'PropertyController@show');
    Route::match(['put', 'patch'], '{property}', 'PropertyController@update');
    Route::delete('{property}', 'PropertyController@destroy');
});