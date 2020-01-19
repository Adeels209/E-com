<?php

namespace App\Http\Controllers;

use App\User;
use App\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Response;
use Modules\Product\Entities\Product;

class WishlistController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        $wishlistProducts = Wishlist::where('user_id', $user->id)->get();
        return view('User.wishlist', compact('wishlistProducts'));
    }

    public function addToWishList(Request $request)
    {
        $product = Product::where('id', $request->product_id)->first();
         $user = User::findOrFail(Auth::user()->id);
            Wishlist::Create([
                Wishlist::$_COLUMN_PRODUCT_ID => $product->id,
                Wishlist::$_COLUMN_USER_ID => $user->id
            ]);
            $wishlistCount = Wishlist::where('user_id',$user->id)->count();
            return Response::json([
                'status'  => 200,
                'refresh' => false,
                'count'=> $wishlistCount
            ]);
        }

    public function removeFromWishList(Request $request)
    {
        Wishlist::where('id', $request->id)->delete();
        return Response::json([
            'status'=>200,
        ]);
    }
}
