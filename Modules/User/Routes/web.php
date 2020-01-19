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

Auth::routes();

Route::prefix('user')->group(function (){
    Route::get('user/register/offical/member','UserController@registerView')->name('register.view');
    Route::post('user/register/offical/member/store','UserController@register')->name('register.store');
    Route::get('/user/{id}/dashboard', 'UserController@index')->name('user.dashboard');
    Route::get('/user/{id}/shipping/details','UserController@shippingDetails')->name('user.shipping.details');
    Route::get('/user/order/details','UserController@myOrders')->name('user.order');
    Route::post('/user/details/update','UserController@updateProfile')->name('profile.update');
    Route::post('/user/details/update/shipping/details','UserController@addressUpdate')->name('address.update');

});

