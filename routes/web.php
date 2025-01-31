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
    return view('index');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/s', function () {
    return view('s');
});
 
 
Route::get('/farm/pigs/preVaccine/{id}', Farm\Pigcycle\VaccineController::class.'@getDataForWeb'); 
Route::resource('/card', Farm\PigCardController::class);