<?php

Route::resource('users', 'UsersController');
Route::resource('roles', 'RolesController');


Route::put('masquerade', 'MasqueradeAsUserController@update');
Route::delete('masquerade', 'MasqueradeAsUserController@destroy');

Route::group(['middleware' => ['auth']], function(){
    Route::resource('announcements', 'AnnouncementsController');
});