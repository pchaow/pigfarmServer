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
    return $request->user();
});

Route::middleware(['auth:api'])->group(function () {

    Route::post('/auth/logout', Auth\LoginController::class . "@logout");

    Route::resource('/roles', Admin\RoleController::class);

    Route::get('/users', function () {
        return \App\Models\User::all();
    });
});

