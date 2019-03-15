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
    Route::resource('/goals', Admin\ReportGoalController::class);

    Route::resource('/users', Admin\UserController::class);
    Route::resource('/choices', Admin\ChoiceController::class);

    Route::resource('/farm/pigs', Farm\PigController::class);
    Route::resource('/farm/pigs.cycles', Farm\PigCycleController::class);


    //Route::get('/pigcycle',Farm\PigCycleController::class.'@getCycleID');

    Route::resource('/farm/pigs.cycles.breeder', Farm\Pigcycle\BreederController::class);
    Route::post('/cycles/breeder/gravid',Farm\Pigcycle\BreederController::class.'@gravid');

    Route::resource('/farm/pigs.cycles.birth', Farm\Pigcycle\BirthController::class);

    Route::resource('/farm/pigs.cycles.feed', Farm\Pigcycle\FeedController::class);
    Route::resource('/farm/pigs.cycles.feedout', Farm\Pigcycle\FeedOutController::class);

    Route::resource('/farm/pigs.cycles.milk', Farm\Pigcycle\MilkController::class);

    Route::resource('/farm/pigs.cycles.vaccine', Farm\Pigcycle\VaccineController::class);




	Route::resource('/card', Farm\PigCardController::class);

});
