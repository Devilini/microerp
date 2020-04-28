<?php

use Illuminate\Http\Request;
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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

//Route::prefix('/transport')->group(function () {
//    Route::get('/', ['uses' => 'TransportController@getTransport']);
//    Route::post('/', ['uses' => 'TransportController@createTransport']);
//    Route::put('/{id}', ['uses' => 'TransportController@updateTransport'])->where(['id' => '[0-9+]']);
//    Route::delete('/{id}', ['uses' => 'TransportController@deleteTransport'])->where(['id' => '[0-9+]']);
//});

Route::apiResources(['transport' => 'API\TransportController']);
