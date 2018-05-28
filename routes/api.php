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
    Route::get('/me', 'UserController@getUserDetail');
});

Route::group(['prefix' => 'place'], function() {
    Route::get('/', 'PlaceController@getPlaceDetail');
    Route::post('/new', 'PlaceController@addPlaceByCSV');
});

Route::group(['prefix' => 'reward'], function() {
    Route::get('/', 'RewardController@getRewardDetail');
    Route::get('/all', 'RewardController@getRewardList');
    Route::post('/new', 'RewardController@addNewReward');
    Route::post('/claim', 'RewardController@claimReward');
});

Route::group(['prefix' => 'challenge'], function() {
    Route::get('/', 'ChallengeController@getChallengeDetail');
    Route::get('/explore', 'ChallengeController@getExplore');
    Route::post('/new', 'ChallengeController@addNewChallenge');
    Route::post('/new_section', 'ChallengeController@addNewChallengeSection');
    Route::post('/go', 'ChallengeController@startChallenge');
});

Route::group(['prefix' => 'user'], function() {
    Route::get('/me', 'UserController@getUserDetail');
});

Route::group(['prefix' => 'migration'], function() {
    Route::post('/places', 'MigrationController@uploadPlaces');
    Route::post('/rewards', 'MigrationController@uploadRewards');
});