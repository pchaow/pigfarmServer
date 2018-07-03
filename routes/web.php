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

Route::get('/pigcycle',Farm\PigCycleController::class.'@getCycleID');

Route::get('/api/breederData',Farm\PigCycleController::class.'@getBreederData');
Route::get('/api/birthData',Farm\PigCycleController::class.'@getBirthData');
Route::get('/api/milkData',Farm\PigCycleController::class.'@getMilkData');
Route::get('/api/getVaccineData',Farm\PigCycleController::class.'@getVaccineData');

Route::post('/api/save.breeder', Farm\PigCycleController::class. '@storeBreeder');
Route::post('/api/save.birth', Farm\PigCycleController::class. '@storeBirth');
Route::post('/api/save.milk', Farm\PigCycleController::class. '@storeMilk');
Route::post('/api/save.vaccine', Farm\PigCycleController::class. '@storeVaccine');


Route::get('/choice',Farm\PigCycleController::class.'@getChoice');
Route::get('/vaccine',Farm\PigCycleController::class.'@getVaccineRecent');
