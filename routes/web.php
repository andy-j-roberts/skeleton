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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('email-verification/check/{token}', 'Auth\VerificationController@verifyAccount');
Route::get('email-verification/error', 'Auth\VerificationController@getVerificationError');
Route::get('verify-account', 'Auth\VerificationController@getVerificationAccountPage');
Route::get('verify-account/send', 'Auth\VerificationController@resendVerificationEmail');