<?php

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

/* AUTH */
Route::namespace('Auth')->prefix('auth')->group(function() {
    Route::name('auth.')->group(function() {
        Route::get('email/verify/{token}', 'VerificationController@verify')->name('verification.verify');
        Route::get('email/resend', 'VerificationController@resend')->name('verification.resend');

        Route::post('email/reset/password', 'PasswordResetController@sendEmailToken')->name('password.reset');
        Route::post('email/password/reset', 'PasswordResetController@resetPassword')->name('reset.password');
    });
    Route::apiResource('register', 'RegisterController')->only('store');
});

/* OAUTH */
Route::prefix('oauth')->name('oauth.')->group(function() {

    Route::post('token', '\Laravel\Passport\Http\Controllers\AccessTokenController@issueToken');

    Route::get('token/validate', function () {
        return ['message' => 'ok', 'code' => 200];
    })->middleware('auth:api');

});

Route::middleware('verified')->namespace('Admin')->prefix('admin')->group(function() {
    Route::name('users.')->group(function() {

    });
    Route::apiResource('users', 'UserController');
});
