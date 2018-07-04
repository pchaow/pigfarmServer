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

Route::post('/auth/login', Auth\LoginController::class . "@apiLogin");

Route::middleware('auth:api')->get('/user', function (Request $request) {
    $user = $request->user();
    $user->roles;
    $user->permissions;
    return $user;
});

Route::middleware(['auth:api'])->group(function () {

    Route::post('/auth/logout', Auth\LoginController::class . "@logout");

    Route::resource('/roles', Admin\RoleController::class);
    Route::resource('/users', Admin\UserController::class);
    Route::resource('/choices', Admin\ChoiceController::class);

    Route::resource('/farm/pigs', Farm\PigController::class);
    Route::resource('/farm/pigs.cycles', Farm\PigCycleController::class);
    Route::get('/pigcycle',Farm\PigCycleController::class.'@getCycleID');

    Route::get('/breederData',Farm\PigCycleController::class.'@getBreederData');
    Route::get('/birthData',Farm\PigCycleController::class.'@getBirthData');
    Route::get('/milkData',Farm\PigCycleController::class.'@getMilkData');
    Route::get('/getVaccineData',Farm\PigCycleController::class.'@getVaccineData');

    Route::post('/save.breeder', Farm\PigCycleController::class. '@storeBreeder');
    Route::post('/save.birth', Farm\PigCycleController::class. '@storeBirth');
    Route::post('/save.milk', Farm\PigCycleController::class. '@storeMilk');
    Route::post('/save.vaccine', Farm\PigCycleController::class. '@storeVaccine');


    Route::get('/choice',Farm\PigCycleController::class.'@getChoice');
    Route::get('/vaccine',Farm\PigCycleController::class.'@getVaccineRecent');

});
