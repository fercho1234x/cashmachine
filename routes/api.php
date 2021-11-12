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

Route::middleware('verified')->namespace('User')->prefix('user')->group(function() {
    Route::name('user.')->group(function() {
        Route::get('information', 'UserController@showInformation')->name('show.information');
    });

    Route::middleware('type.account:debito')->prefix('debit/transactions')->name('user.transactions')->group(function() {
        Route::middleware('can:addFoundsDebitAccount,account')
            ->post('add-founds/{account}', 'UserTransactionsController@addFoundsDebitAccount')
            ->name('add.founds');
        Route::middleware('can:withdrawFoundsDebitAccount,account')
            ->post('withdraw-founds/{account}', 'UserTransactionsController@withdrawFoundsDebitAccount')
            ->name('withdraw.founds');
    });

    Route::middleware(['can:withdrawFoundsCreditAccount,account', 'type.account:credito', 'type.user:tipo2|tipo3|tipo4'])->prefix('credit/transactions')->name('user.credit.transactions')->group(function() {
        Route::middleware('can:withdrawFoundsCreditAccount,account')
            ->post('withdraw-founds/{account}', 'UserTransactionsController@withdrawFoundsCreditAccount')->name('withdraw.founds');
        Route::middleware('can:payTheCreditCard,account')
            ->post('pay/{account}', 'UserTransactionsController@payTheCreditCard')
            ->name('pay');
    });
});
