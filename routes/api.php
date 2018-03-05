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

Route::group(['prefix' => 'auth'], function() {
    Route::get('/invitation', 'AuthController@verifyInvitationCode');
    Route::get('/new', 'AuthController@generateInvitationCode');
    Route::post('/facebook', 'AuthController@login');
});

Route::group(['prefix' => 'place'], function() {
    Route::get('/', 'PlaceController@getPlaceDetail');
    Route::post('/new', 'PlaceController@addNewPlace');
});

Route::group(['prefix' => 'reward'], function() {
    Route::get('/', 'RewardController@getRewardDetail');
    Route::post('/new', 'RewardController@addNewReward');
});