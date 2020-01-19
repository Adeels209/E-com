<?php
/**
 * Created by PhpStorm.
 * User: rehman
 * Date: 4/2/2019
 * Time: 11:08 AM
 */

namespace App;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Modules\Admin\Entities\Category;
use Modules\Product\Entities\Product;
use Modules\Product\Entities\Size;

class DataComposer
{
    public function compose(View $view)
    {
        $user = Auth::user();
        if(isset($user)){
            $wishlistCount = Wishlist::where('user_id',$user->id)->count();
        }
        $siteSettings = SiteSettings::all();
        $categories = Category::where('parent_id', NULL)->with(['childCategory' => function($query){
            $query->take(4);
        }])->limit(2)->get();
        $sizes = Size::all();
        $cart_key = Session::get(Cart::$CART_KEY);
        $cart_products =   Cart::where(Cart::$SESSION_ID_COLUMN,$cart_key)->get();
        foreach($cart_products as $cart_product) {
            $cartProducts = Product::join('carts', 'products.id', 'carts.product_id')->select('products.*', 'carts.quantity', 'carts.id as cart_id')->where(Cart::$SESSION_ID_COLUMN, $cart_key)->get();
            $productCount = Product::join('carts', 'products.id', 'carts.product_id')->select('products.*', 'carts.quantity', 'carts.id as cart_id')->where(Cart::$SESSION_ID_COLUMN, $cart_key)->count();
            $total = 0;
            foreach ($cartProducts as $products) {
                $selling_price = $products->selling_price;
                $qty = $products->quantity;
                if (isset($products->discount)) {
                    $selling_price = $products->selling_price - ($products->discount->discount->discount / 100 * $products->selling_price);
                    $total += $selling_price * $qty;
                } else {
                    $total += $selling_price * $qty;
                }
            }
        }
        if(isset($cartProducts)) {
            $view->with('cartProducts', $cartProducts);
            $view->with('productCount', $productCount);
            $view->with('total', $total);
        }
        if(isset($categories)) {
            $view->with('categories', $categories);
        }
        if(isset($sizes)) {
            $view->with('sizes', $sizes);
        }
        if(isset($siteSettings)){
//            $sale_one = Product::where('id', $siteSettings[0]->sale_one)->first();
//            $sale_two = Product::where('id', $siteSettings[0]->sale_two)->first();
//            $featured_one = Product::where('id', $siteSettings[0]->is_featured_one)->first();
//            $featured_two = Product::where('id', $siteSettings[0]->is_featured_two)->first();
            $view->with('siteSettings', $siteSettings);
//            $view->with('sale_one', $sale_one);
//            $view->with('sale_two', $sale_two);
//            $view->with('featured_one', $featured_one);
//            $view->with('featured_two', $featured_two);
        }
        if(isset($wishlistCount)) {
            $view->with('wishlistCount', $wishlistCount);
        }
    }
}