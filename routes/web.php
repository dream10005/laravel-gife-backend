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
Route::get('/form_place', function() {
    return view('formAddPlace');
});
Route::get('/form_challenge', function() {
    return view('formAddChallenge');
});
Route::get('/form_reward', function() {
    return view('formAddReward');
});


Route::get('/place_success', function() {
    return redirect('/form_place')->with('success', 'Add data success');
});
Route::get('/place_error', function() {
    return redirect('/form_place')->with('success', 'Add data failed');
});


Route::get('/challenge_success', function() {
    return redirect('/form_challenge')->with('success', 'Add data success');
});
Route::get('/challenge_error', function() {
    return redirect('/form_challenge')->with('success', 'Add data failed');
});

Route::get('/reward_success', function() {
    return redirect('/form_reward')->with('success', 'Add data success');
});
Route::get('/reward_error', function() {
    return redirect('/form_reward')->with('success', 'Add data failed');
});
