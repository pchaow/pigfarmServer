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
    Route::get('/farm/pigs/preVaccine/{id}', Farm\Pigcycle\VaccineController::class.'@getDataForWeb'); 

    Route::resource('/farm/pigs/breeder', Farm\Pigcycle\BreederController::class); 
    Route::resource('/farm/pigs/birth', Farm\Pigcycle\BirthController::class); 
    Route::resource('/farm/pigs/feed', Farm\Pigcycle\FeedController::class); 
    Route::resource('/farm/pigs/feedout', Farm\Pigcycle\FeedOutController::class); 
    Route::resource('/farm/pigs/milk', Farm\Pigcycle\MilkController::class); 
    Route::resource('/farm/pigs/vaccine', Farm\Pigcycle\VaccineController::class); 

});
