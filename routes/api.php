<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('send-code', [\App\Http\Controllers\Api\Auth\UserController::class, "sendCode"]);
Route::post('register-login', [\App\Http\Controllers\Api\Auth\UserController::class, "RegisterLogin"]);

Route::group(['prefix' => "v1/"], function () {
    Route::group(['prefix' => "question", 'middleware' => 'auth:api'], function () {
        Route::resource('/',\App\Http\Controllers\Api\v1\QuestionController::class)->except(['show']);
    });
});

