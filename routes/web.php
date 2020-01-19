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
Route::get('/', 'HomeController@index')->name('home');
Route::get('/contact', 'HomeController@contact')->name('contact');
Route::get('/about','HomeController@about')->name('about');
Route::get('/search/results','HomeController@search')->name('search');
Route::post('result','HomeController@searchedProducts')->name('searched');

// Wishlist Routes//
Route::get('/wishlist/products/User', 'WishlistController@index')->name('wishlist');
Route::post('/wishlist/product/add/', 'WishlistController@addToWishList')->name('add.to.wishlist');
Route::post('/wishlist/product/delete/', 'WishlistController@removeFromWishList')->name('wishlist.remove');
// Wishlist Routes //

Route::get('/products/xml', 'HomeController@xmlProducts')->name('products.xml');
Route::get('/orders/xml', 'HomeController@xmlOrders')->name('orders.xml');


// Product Routes//
Route::get('/{slug}','HomeController@specificProduct')->name('specific.product');
Route::get('/product/extra/for/u/asdqwds/sgereqw/{slug}', 'HomeController@subCategoryProducts')->name('subcat.products');
Route::get('product/extra/{slug}/ssaqas/wqcv', 'HomeController@categoryProducts')->name('cat.products');
Route::get('/product/shop/all','HomeController@shop')->name('shop');
Route::get('/product/extra/all', 'HomeController@selectFromPrice')->name('range.price');
Route::get('/product/extra/all/size/{id}', 'HomeController@selectFromSize')->name('range.size');
Route::get('/image/all/product', 'HomeController@allImages')->name('all.images');
Route::get('/product/360/view','HomeController@productThree60View')->name('360view');
//Product Routes//

//Cart Routes//
Route::post('/add/to/cart','CartController@addToCart')->name('my.cart');
Route::post('remove/from/cart/{id}','CartController@removeFromCart')->name('remove.from.cart');
Route::post('remove/from/incart/{id}','CartController@removeFromCartInCart')->name('remove.from.cart.incart');
Route::get('view/cart','CartController@viewCart')->name('view.cart');
Route::post('view/cart/update','CartController@updateCart')->name('cart.update');
//Cart Routes//

// Checkout Routes //
Route::post('/shipping/details', 'CartController@orderShippingDetails')->name('shipping.details');
Route::get('/view/checkout/form','CartController@checkOutCart')->name('checkout');
Route::post('/place/order/', 'CartController@placeOrderCashOnDelivery')->name('place.order.cash');
Route::post('/place/order/credit/card', 'CartController@placeOrderCardPayment')->name('place.order');
Route::get('/payment/complete/success/{id}', 'CartController@success')->name('success');
Route::get('/your/product/order/status/all', 'HomeController@guestOrder')->name('guest.order');
Route::get('/view/cart/coupon', 'CartController@checkCoupon')->name('coupon.check');
//Checkout Routes//

Route::post('/contact/save','HomeController@contactSave')->name('contact.save');

Auth::routes();

Route::prefix('user')->group(function (){

    Route::get('/login', 'Auth\LoginController@showsignupform')->name('user.login');
    Route::get('/', 'HomeController@index')->name('index');
    Route::get('/logout', 'Auth\LoginController@logout')->name('user.logout');

});