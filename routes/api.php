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

Route::get('/place', 'PlaceController@getPlaceDetailById');
Route::get('/code', 'AuthController@verifyInvitationCode');
Route::get('/test', 'AuthController@test');
Route::get('/place', 'PlaceController@getPlaceDetail');
Route::post('/place', 'PlaceController@postAddNewPlace');
