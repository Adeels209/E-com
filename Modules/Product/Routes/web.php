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


Route::prefix('admin/size')->group(function (){

    Route::get('/index', 'AdminSizeController@index')->name('admin.size.index');
    Route::get('/create', 'AdminSizeController@create')->name('admin.size.create');
    Route::post('/store', 'AdminSizeController@store')->name('admin.size.store');
    Route::get('/edit/{id}', 'AdminSizeController@edit')->name('admin.size.edit');
    Route::post('/update/{id}', 'AdminSizeController@update')->name('admin.size.update');
    Route::post('/delete', 'AdminSizeController@destroy')->name('admin.size.delete');

});

Route::prefix('admin/colors')->group(function (){

    Route::get('/index', 'AdminColorsController@index')->name('admin.colors.index');
    Route::get('/create', 'AdminColorsController@create')->name('admin.colors.create');
    Route::post('/store', 'AdminColorsController@store')->name('admin.colors.store');
    Route::get('/edit/{id}', 'AdminColorsController@edit')->name('admin.colors.edit');
    Route::post('/update/{id}', 'AdminColorsController@update')->name('admin.colors.update');
    Route::post('/delete', 'AdminColorsController@destroy')->name('admin.colors.delete');

});

Route::prefix('admin/product')->group(function (){

    Route::get('/index', 'AdminProductsController@index')->name('admin.product.index');
    Route::get('/create', 'AdminProductsController@create')->name('admin.product.create');
    Route::post('/store', 'AdminProductsController@store')->name('admin.product.store');
    Route::get('/edit/{slug}', 'AdminProductsController@edit')->name('admin.product.edit');
    Route::post('/update/{slug}', 'AdminProductsController@update')->name('admin.product.update');
    Route::post('/delete', 'AdminProductsController@destroy')->name('admin.product.delete');
    Route::get('/apply/discount/product/all', 'AdminProductsController@discountAllProducts')->name('admin.discount.all');
    Route::post('/apply/discount/product', 'AdminProductsController@applyDiscount')->name('admin.product.discount.store');
    Route::post('/remove/discount/product', 'AdminProductsController@removeDiscount')->name('admin.discount.remove');

});

Route::prefix('admin/product/media')->group(function (){

    Route::get('/index/{slug}', 'AdminProductsController@productMedia')->name('product.image');
    Route::get('/index/{slug}/panorama/view', 'AdminProductsController@panoramaView')->name('product.image.panorama.view');
    Route::post('/panorama', 'AdminProductsController@productPanaramaImages')->name('product.image.panorama');
    Route::post('/store', 'AdminProductsController@productMediaStore')->name('product.image.store');
    Route::post('/delete', 'AdminProductsController@mediaDestroy')->name('admin.image.delete');
    Route::post('/delete/panorama', 'AdminProductsController@mediaPanoramaDestroy')->name('admin.image.panorama.delete');

});

Route::prefix('admin/product/stock')->group(function (){

    Route::get('/index', 'AdminProductStocksController@index')->name('admin.stock.index');
    Route::get('/create', 'AdminProductStocksController@create')->name('admin.stock.create');
    Route::post('/store', 'AdminProductStocksController@store')->name('admin.stock.store');
    Route::get('/check/{id}', 'AdminProductStocksController@checkStock')->name('admin.stock.check');
    Route::get('/edit/{id}', 'AdminProductStocksController@edit')->name('admin.stock.edit');
    Route::post('/update/{id}', 'AdminProductStocksController@update')->name('admin.stock.update');
    Route::post('/delete', 'AdminProductStocksController@destroy')->name('admin.stock.delete');

});

Route::prefix('admin/discount')->group(function (){

    Route::get('/index', 'AdminDiscountsController@index')->name('admin.discount.index');
    Route::get('/create', 'AdminDiscountsController@create')->name('admin.discount.create');
    Route::post('/store', 'AdminDiscountsController@store')->name('admin.discount.store');
    Route::get('/edit/{id}', 'AdminDiscountsController@edit')->name('admin.discount.edit');
    Route::post('/update/{id}', 'AdminDiscountsController@update')->name('admin.discount.update');
    Route::post('/delete', 'AdminDiscountsController@destroy')->name('admin.discount.delete');

});

Route::prefix('admin/coupon')->group(function (){

    Route::get('/index', 'AdminCouponsController@index')->name('admin.coupon.index');
    Route::get('/create', 'AdminCouponsController@create')->name('admin.coupon.create');
    Route::post('/store', 'AdminCouponsController@store')->name('admin.coupon.store');
    Route::get('/edit/{id}', 'AdminCouponsController@edit')->name('admin.coupon.edit');
    Route::post('/update/{id}', 'AdminCouponsController@update')->name('admin.coupon.update');
    Route::post('/delete', 'AdminCouponsController@destroy')->name('admin.coupon.delete');

});




