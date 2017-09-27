<?php


Route::put('masquerade', 'MasqueradeAsUserController@update');
Route::delete('masquerade', 'MasqueradeAsUserController@destroy');

Route::group(['middleware' => ['auth','verified']], function(){
    Route::resource('settings', 'SettingsController');
    Route::resource('users', 'UsersController');
    Route::resource('roles', 'RolesController');
    Route::resource('pages', 'PagesController');

});