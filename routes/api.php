<?php

use App\Http\Controllers\Authentication\AuthenticationLoginController;
use App\Http\Controllers\Authentication\AuthenticationLogoutController;
use App\Http\Controllers\Authentication\AuthenticationMeController;
use App\Http\Controllers\Authentication\AuthenticationRefreshController;
use App\Http\Controllers\Authentication\AuthenticationSignupController;
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

Route::group(['prefix' => 'v1'], function ($router) {

    Route::group(['prefix' => 'auth'], function ($router) {
        Route::post('/signup', AuthenticationSignupController::class)->name('signup');
        Route::post('/login', AuthenticationLoginController::class)->name('login');
        Route::post('/logout', AuthenticationLogoutController::class)->middleware('jwt.verify')->name('logout');
        Route::post('/refresh', AuthenticationRefreshController::class)->middleware('jwt.verify')->name('refresh');
        Route::post('/me', AuthenticationMeController::class)->middleware('jwt.verify')->name('me');
    });



});
