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
Route::demoAccess('/demo');
Route::get('/', function () {
    return view('welcome');
});
Route::get('/under-construction', function () {
    return view('under_construction');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::group(['middleware' => ['demo']], function(){
    Route::get('{permalink?}', 'PagesController');
});


Route::get('email-verification/check/{token}', 'Auth\VerificationController@verifyAccount');
Route::get('email-verification/error', 'Auth\VerificationController@getVerificationError');
Route::get('verify-account', 'Auth\VerificationController@getVerificationAccountPage');
Route::get('verify-account/send', 'Auth\VerificationController@resendVerificationEmail');