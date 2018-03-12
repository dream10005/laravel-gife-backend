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
    //session()->put('place', 'complete');
    return view('formAddPlace');
});
Route::get('/success', function() {
    return redirect('/form_place')->with('success', 'Add data complete');
});
Route::get('/error', function() {
    return view('formAddPlace')->with('success', 'Add data failed');
});
