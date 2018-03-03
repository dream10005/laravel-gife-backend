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

Route::group(['prefix' => 'auth', 'namespace' => 'Api'], function() {
    Route::get('/invitation', 'AuthController@verifyInvitationCode');
    Route::get('/new', 'AuthController@generateInvitationCode');
});

Route::group(['prefix' => 'place', 'namespace' => 'Api'], function() {
    Route::get('/place', 'PlaceController@getPlaceDetailById');
    Route::get('/place', 'PlaceController@getPlaceDetail');
    Route::post('/place', 'PlaceController@postAddNewPlace');
});