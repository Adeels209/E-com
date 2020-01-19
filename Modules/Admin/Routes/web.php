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


use Illuminate\Support\Facades\Auth;

Auth::routes();

Route::prefix('admin')->group(function (){

    Route::get('/login', 'AdminLoginController@showLoginForm')->name('admin.login');
    Route::get('/dashboard', 'AdminController@index')->name('admin.dashboard');
    Route::post('/login', 'AdminLoginController@login')->name('admin.login.submit');
    Route::get('/logout', 'AdminLoginController@logout')->name('admin.logout');
    Route::get('/users', 'AdminController@index_users')->name('admin.users');
    Route::post('/mar/as/read', 'AdminController@markAsRead')->name('mark.as.read');

});

Route::prefix('admin/role')->group(function (){

    Route::get('/create','AdminRoleController@create')->name('role.create');
    Route::get('/index', 'AdminRoleController@index')->name('role.index');
    Route::post('/store', 'AdminRoleController@store')->name('role.store');
    Route::get('/edit/{id}','AdminRoleController@edit')->name('role.edit');
    Route::post('/update/{id}', 'AdminRoleController@update')->name('role.update');
    Route::post('/delete', 'AdminRoleController@destroy')->name('role.delete');


});

Route::prefix('admin/user')->group(function (){

    Route::get('/index', 'AdminUsersController@index')->name('admin.users.index');
    Route::get('/create', 'AdminUsersController@create')->name('admin.users.create');
    Route::post('/store', 'AdminUsersController@store')->name('user.store');
    Route::get('/edit/{id}', 'AdminUsersController@edit')->name('admin.user.edit');
    Route::post('/update/{id}', 'AdminUsersController@update')->name('user.update');
    Route::post('/delete', 'AdminUsersController@destroy')->name('user.delete');

});


Route::prefix('admin/category')->group(function (){

    Route::get('/index', 'AdminCategoriesController@index')->name('admin.category.index');
    Route::get('/create', 'AdminCategoriesController@create')->name('admin.category.create');
    Route::post('/store', 'AdminCategoriesController@store')->name('admin.category.store');
    Route::get('/edit/{id}', 'AdminCategoriesController@edit')->name('admin.category.edit');
    Route::post('/update/{id}', 'AdminCategoriesController@update')->name('admin.category.update');
    Route::post('/delete', 'AdminCategoriesController@destroy')->name('admin.category.delete');

});

Route::prefix('admin/sub-category')->group(function (){

    Route::get('/index', 'AdminSubCategoriesController@index')->name('admin.sub-category.index');
    Route::get('/create', 'AdminSubCategoriesController@create')->name('admin.sub-category.create');
    Route::post('/store', 'AdminSubCategoriesController@store')->name('admin.sub-category.store');
    Route::get('/edit/{id}', 'AdminSubCategoriesController@edit')->name('admin.sub-category.edit');
    Route::post('/update/{id}', 'AdminSubCategoriesController@update')->name('admin.sub-category.update');
    Route::post('/delete', 'AdminSubCategoriesController@destroy')->name('admin.sub-category.delete');

});

Route::prefix('admin/brand')->group(function (){

    Route::get('/index', 'AdminBrandsController@index')->name('admin.brand.index');
    Route::get('/create', 'AdminBrandsController@create')->name('admin.brand.create');
    Route::post('/store', 'AdminBrandsController@store')->name('admin.brand.store');
    Route::get('/edit/{id}', 'AdminBrandsController@edit')->name('admin.brand.edit');
    Route::post('/update/{id}', 'AdminBrandsController@update')->name('admin.brand.update');
    Route::post('/delete', 'AdminBrandsController@destroy')->name('admin.brand.delete');

});

Route::prefix('admin/order')->group(function (){

    Route::get('/index', 'AdminOrdersController@index')->name('admin.order.index');
    Route::post('/store', 'AdminOrdersController@store')->name('admin.order.store');
    Route::get('/check/{id}', 'AdminOrdersController@orderCheck')->name('admin.order.check');

});

Route::prefix('admin/website/slider')->group(function (){

    Route::get('/index', 'AdminOrdersController@index')->name('admin.slider.index');
    Route::get('/create', 'WebsiteConfigController@create')->name('admin.slider.create');
    Route::post('/store/{id}', 'WebsiteConfigController@sliderStore')->name('admin.slider.store');
    Route::get('/edit/{id}', 'AdminBrandsController@edit')->name('admin.brand.edit');
    Route::post('/update/{id}', 'AdminBrandsController@update')->name('admin.brand.update');
    Route::post('/delete', 'AdminBrandsController@destroy')->name('admin.brand.delete');

});

Route::prefix('admin/website/testimonial')->group(function (){

    Route::get('/index', 'WebsiteConfigController@testimonialIndex')->name('admin.testimonial.index');
    Route::post('/update', 'WebsiteConfigController@testimonialUpdate')->name('admin.testimonial.update');
});

Route::prefix('admin/website/testimonial/reviews')->group(function (){

    Route::get('/index', 'WebsiteConfigController@testimonialReviewsIndex')->name('admin.testimonialreviews.index');
    Route::post('/store', 'WebsiteConfigController@testimonialReviewsStore')->name('admin.reviews.store');
    Route::post('/update', 'WebsiteConfigController@testimonialReviewsUpdate')->name('admin.testimonialreviews.update');
    Route::get('/delete', 'WebsiteConfigController@testimonialReviewsdestroy')->name('admin.testimonialreviews.delete');
});

Route::prefix('admin/website/sitesettings')->group(function (){

    Route::get('/index', 'WebsiteConfigController@siteSettingsView')->name('admin.sidesetting.index');
    Route::post('/update', 'WebsiteConfigController@siteSettingsUpdate')->name('admin.sitesettings.update');
    Route::get('/delete', 'WebsiteConfigController@testimonialReviewsdestroy')->name('admin.testimonialreviews.delete');
});

