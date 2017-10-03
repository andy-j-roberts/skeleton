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
Route::group(['middleware' => ['auth:api']], function(){
   Route::get('/user','AuthenticatedUserController');
    Route::get('/subscriptions','Users\SubscriptionsController');
    Route::put('/subscription', 'Users\UpdateSubscriptionController@update');
    Route::get('card-details', 'Users\CardDetailsController@index');
    Route::post('purchase-product/{product}', 'PurchaseProductsController');
});
