<?php

namespace App\Providers;

use Illuminate\Support\Composer;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        View::composer(
            ['User.index','User.auth.login-reg','User.about','User.contact','User.layouts.header','User.layouts.footer','User.layouts.head','User.layouts.master','User.layouts.navbar','User.layouts.sponsors','User.layouts.testimonial','User.cart.cart', 'User.cart.checkout','User.order-number', 'User.product.category-products', 'User.product.sub-category-products', 'User.product.product-sidebar','User.contact'],
            'App\DataComposer'
        );
    }
}
