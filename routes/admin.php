<?php


Route::put('masquerade', 'MasqueradeAsUserController@update');
Route::delete('masquerade', 'MasqueradeAsUserController@destroy');

Route::group(['middleware' => ['auth']], function(){
    Route::resource('plans','PlansController');
    Route::get('stripe/sync-plans', 'Stripe\SyncPlansController');
    Route::resource('settings', 'SettingsController');
    Route::resource('users', 'UsersController');
    Route::resource('roles', 'RolesController');
    Route::resource('pages', 'PagesController');
    Route::resource('announcements', 'AnnouncementsController');
});