<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Cart;
use App\Http\Requests\ShippingDetailsRequest;
use App\Mail\OrderSuccessfulMail;
use App\Notifications\NotifyLowQuantity;
use App\Notifications\OrderSuccessNotification;
use App\Notifications\ProductIsOutOfStock;
use App\Order;
use App\OrderItem;
use App\User;
use Carbon\Carbon;
use DOMDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Modules\Product\Entities\Color;
use Modules\Product\Entities\Coupon;
use Modules\Product\Entities\CouponHistory;
use Modules\Product\Entities\Product;
use Modules\Product\Entities\Size;
use Modules\Product\Entities\Stock;
use Modules\User\Entities\Address;

class CartController extends Controller
{


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __construct()
    {
        $this->middleware('auth:web');
    }



    public function addToCart(Request $request)
    {
      $product = Product::findOrFail($request->product_id);
      if($product->stock->quantity > 0 && $request->quantity <= 10) {
          if(!Size::where('id', $request->size_id)->first()){
              return response()->json(['status'=>300]);
          }
          if(!Color::where('id', $request->color_id)->first()){
              return response()->json(['status'=>900]);
          }
          $color = Color::findOrFail($request->color_id);
           $dim = Size::findOrFail($request->size_id);
          if($request->size_id != $dim->id){
              return response()->json(['status'=>300]);
          }
          if($request->color_id != $color->id){
              return response()->json(['status'=>300]);
          }
          $qty = $request->quantity;
          if (Session::has(Cart::$CART_KEY)) {
              $cart_key = Session::get(Cart::$CART_KEY);
          } else {
              Session::put(Cart::$CART_KEY, str_random(20));
              $cart_key = Session::get(Cart::$CART_KEY);
          }
          $cart = Cart::where(Cart::$SESSION_ID_COLUMN, $cart_key)->where(Cart::$PRODUCT_ID_COLUMN, $product->id)->where(Cart::$COLOR_COLUMN, $color->color)->where(Cart::$SIZE_COLUMN, $dim->size)->get();
          $cartCheck = Cart::where(Cart::$SESSION_ID_COLUMN, $cart_key)->where(Cart::$PRODUCT_ID_COLUMN, $product->id)->where(Cart::$COLOR_COLUMN, $color->color)->where(Cart::$SIZE_COLUMN, $dim->size)->first();
          if (count($cart) > 0) {
              if ($cartCheck->quantity < $cartCheck->product->stock->quantity) {
                  if( $qty + $cartCheck->quantity > $cartCheck->product->stock->quantity){
                      return response()->json(['status'=>600,'response'=>'no :D']);
                  }
                  Cart::where(Cart::$SESSION_ID_COLUMN, $cart_key)->where(Cart::$PRODUCT_ID_COLUMN, $request->product_id)->where(CART::$COLOR_COLUMN, $color->color)->where(CART::$SIZE_COLUMN, $dim->size)->increment(Cart::$QTY_COLUMN, $qty);
                  $cart = Cart::where(Cart::$SESSION_ID_COLUMN, $cart_key)->where(Cart::$PRODUCT_ID_COLUMN, $request->product_id)->where('color', $color->color)->orwhere('size', $dim->size)->first();
                  $cart_product = Cart::where(Cart::$SESSION_ID_COLUMN, $cart_key)->where(Cart::$PRODUCT_ID_COLUMN, $request->product_id)->with('product')->first();

                  $cart_total = Cart::where(Cart::$SESSION_ID_COLUMN, $cart_key)->get();
                  $count = count($cart_total);

                  $total = 0;
                  foreach ($cart_total as $products) {
                      if (isset($products->product->discount)) {
                          $selling_price = $products->product->selling_price - ($products->product->discount->discount->discount / 100 * $products->product->selling_price);
                          $total += $selling_price * $qty;
                      } else {
                          $selling_price = $products->product->selling_price;
                          $qty = $products->quantity;
                          $total += $selling_price * $qty;
                      }

                  }
                  return Response::json([
                      'status'       => 400,
                      'already'      => 1,
                      'cart'         => $cart,
                      'cart_total'   => $total,
                      'cart_product' => $cart_product,
                      'cart_image'   => $cart_product,
                      'count'        => $count
                  ]);
              } else {
                  if (count($cart) > 0 && $cartCheck->quantity == $cartCheck->product->stock->quantity) {
                      return Response::json([
                          'status'   => 500,
                          'response' => 'You have maximum quantity of the product in cart'
                      ]);
                  }
              }
          } else {
              $cart = Cart::create([
                  Cart::$PRODUCT_ID_COLUMN => $request->product_id,
                  Cart::$SESSION_ID_COLUMN => $cart_key,
                  Cart::$COLOR_COLUMN      => $color->color,
                  Cart::$SIZE_COLUMN       => $dim->size,
                  Cart::$QTY_COLUMN        => $qty,
              ]);
              $cart_total = Cart::where(Cart::$SESSION_ID_COLUMN, $cart_key)->get();
              $total = 0;
              $count = count($cart_total);
              foreach ($cart_total as $products) {
                  if(isset($products->product->discount)){
                      $selling_price = $products->product->selling_price - ($products->product->discount->discount->discount / 100 * $products->product->selling_price);
                      $total+= $selling_price * $qty;
                  } else {
                      $selling_price = $products->product->selling_price;
                      $qty = $products->quantity;
                      $total += $selling_price * $qty;
                  }
              }
              return Response::json([
                  'status'        => 200,
                  'cart'          => $cart,
                  'cart_total'    => $total,
                  'count'         => $count,
                  'cart_product'  => $cart->product,
                  'cart_images'   => $cart->product->images
              ]);
          }
      } elseif($product->stock->quantity <= 0) {
          return Response::json([
              'status'=> -21,
              'response' => 'Product is out of stock'
          ]);
      } else {
          if($request->quantity > 10){
              return response()->json(['response'=> -1]);
          }
      }
    }

    public function viewCart()
    {
        $cart_key = Session::get(Cart::$CART_KEY);
        $cart_products =   Cart::where(Cart::$SESSION_ID_COLUMN,$cart_key)->get();
        if (count($cart_products) < 0) {
            return back();
        }
        foreach($cart_products as $cart_product) {
//           return $cart_product->product->stock;
//            $cartProducts = Product::where('id', $cart_product->product_id)->get();
            $cartProducts = Product::join('carts', 'products.id', 'carts.product_id')->select('products.*', 'carts.quantity', 'carts.id as cart_id')->where(Cart::$SESSION_ID_COLUMN, $cart_key)->get();
            $total = 0;
            foreach ($cartProducts as $products) {
                $selling_price = $products->selling_price;
                $qty = $cart_product->quantity;
                if (isset($products->discount)) {
                    $selling_price = $products->selling_price - ($products->discount->discount->discount / 100 * $products->selling_price);
                    $total += $selling_price * $qty;
                } elseif(!isset($products->discount)) {
                     $total += $selling_price * $qty;
                }
            }
        }
        return view('User.cart.cart',compact('cart_products', count($cart_products) > 0 ? 'total' : null));
    }

    public function removeFromCart(Request $request, $id){
        $cart=Cart::find($id);
        $cart->delete();
        $request->session()->flash('deleted','Product removed from Cart');
        return redirect(route('home'));
    }

    public function removeFromCartInCart(Request $request, $id){
        $cart = Cart::find($id);
        $cart->delete();
        session()->forget(Cart::$CART_KEY);
        $request->session()->flash('deleted','Product removed from Cart');
        return back();
    }

    public function updateCart(Request $request)
    {
        $carts = Cart::where('id', $request->id)->first();
        if($request->qty > $carts->product->stock->quantity){
            return response()->json(['status'=>400, 'response'=>'no:D','cart'=>$carts]);
        }
        if($request->qty >= 0 && $request->qty <=10) {
            $cart = Cart::where('id', $request->id)->update(['quantity' => $request->qty]);
            $cartQuan = Cart::where('id', $request->id)->first();
            $cart_key = Session::get(Cart::$CART_KEY);
            $cart_item = Cart::where(Cart::$SESSION_ID_COLUMN, $cart_key)->get();
            $total = 0;
            foreach ($cart_item as $c_total) {
                if(isset($c_total->product->discount)){
                    $selling_price = $c_total->product->selling_price-($c_total->product->discount->discount->discount / 100 * $c_total->product->selling_price);
                    $qty = $c_total->quantity;
                    $total+= $selling_price * $qty;
                } else {
                    if(!isset($c_total->product->discount)) {
                        $selling_price = $c_total->product->selling_price;
                        $qty = $c_total->quantity;
                        $total += $selling_price * $qty;
                    }
                }
            }
            return Response::json([
                'status'     => 200,
                'cart'       => $cart,
                'cart_total' => $total,
                'cartQuan'   => $cartQuan

            ]);
        } else {
            $cart = Cart::where('id', $request->id)->first();
            $cart_key = Session::get(Cart::$CART_KEY);
            $cart_item = Cart::where(Cart::$SESSION_ID_COLUMN, $cart_key)->get();
            $total = 0;
            foreach ($cart_item as $c_total) {
                if(isset($c_total->product->discount)){
                    $selling_price = $c_total->product->selling_price-($c_total->product->discount->discount->discount / 100 * $c_total->product->selling_price);
                    $qty = $c_total->quantity;
                    $total+= $selling_price * $qty;
                } else {
                    if(!isset($c_total->product->discount)) {
                        $selling_price = $c_total->product->selling_price;
                        $qty = $cart_item->quantity;
                        $total += $selling_price * $qty;
                    }
                }
            }
            return Response::json([
                'status'     => 200,
                'cart'       => $cart,
                'cart_total' => $total,

            ]);
        }
    }

    public function checkCoupon(Request $request)
    {
        $coupon = $request->coupon;
        $coupon=Coupon::where('coupon_no',$coupon)->first();
        if($coupon)
        {
            $couponUsed=CouponHistory::where('coupon_no', $request->coupon)->first();
            if(isset($couponUsed)){
                return Response::json([
                    'status'    => -2,
                    'refresh'   => false
                ]);
            } else {
                $request->session()->put('coupon',$coupon->id );
                $price = $coupon->discount;
                return Response::json([
                    'status'    => 200,
                    'refresh'   => false
                ]);
            }
        } else {
            return Response::json([
                'status'    => "-1",
                'refresh'   => false
            ]);
        }

    }

    public function checkOutCart(Request $request)
    {
        $cart_secret = Session::get(Cart::$CART_KEY);
        $cart = Cart::where(Cart::$SESSION_ID_COLUMN, $cart_secret)->get();
        if(count($cart) < 1){
            $request->session()->flash('cart_empty', 'Your Cart is empty');
            return redirect()->back();
        }
        if ($user = Auth::user()) {
            return view('User.cart.checkout', compact('user'));
        } else {
            return view('User.cart.checkout');
        }
    }

    public function orderShippingDetails(ShippingDetailsRequest $request)
    {
        $cart_secret = Session::get(Cart::$CART_KEY);
        $cart = Cart::where(Cart::$SESSION_ID_COLUMN, $cart_secret)->get();
        if(count($cart) < 1){
            $request->session()->flash('cart_empty', 'Your Cart is empty');
            return redirect()->back();
        }
        if($user = Auth::user()) {
            if (isset($user->address)) {
                $userAddress = Address::findOrFail($user->address->id);
                $userAddress->address = $request->address;
                $userAddress->address_appartment = $request->address_apartment;
                $userAddress->phone_number = $request->phone_number;
                $userAddress->zip_code = $request->zipcode;
                $userAddress->city = $request->city;
                $userAddress->user_id = $user->id;
                $userAddress->save();
            } else {
//                return $request->all();
                $address = new Address();
                $address->address = $request->address;
                $address->address_appartment = $request->address_apartment;
                $address->phone_number = $request->phone_number;
                $address->zip_code = $request->zipcode;
                $address->city = $request->city;
                $address->user_id = $user->id;
                $address->save();
            }
        }
        session()->put('fname', $request->fname);
        session()->put('lname', $request->lname);
        session()->put('phonenumber', $request->phone_number);
        session()->put('email', $request->email);
        session()->put('address', $request->address);
        session()->put('address_apartment', $request->address_apartment);
        session()->put('city', $request->city);
        session()->put('zipcode', $request->zipcode);
        session()->put('user_note', $request->user_note);
        $name = $request->fname;
        $lname = $request->lname;
        $phonenumber = $request->phone_number;
        $email = $request->email;
        $address = $request->address;
        $apartment_address = $request->address_apartment;
        $city = $request->city;
        $zipcode = $request->zipcode;
        $user_note = $request->user_note;
        $cart_key = Session::get(Cart::$CART_KEY);
        $cart_products = Cart::where(Cart::$SESSION_ID_COLUMN, $cart_key)->get();
        $total = 0;
        $totals = 0;
        foreach ($cart_products as $cart) {
            if (isset($cart->product->discount)) {
                $selling_price = $cart->product->selling_price - ($cart->product->discount->discount->discount / 100 * $cart->product->selling_price);
            } else {
                $selling_price = $cart->product->selling_price;
            }
            $quantity = $cart->quantity;
            $total += $selling_price * $quantity;
            if (session()->has('coupon')) {
                $coupons = Coupon::where('id', session()->get('coupon'))->first();
                $totals += $selling_price * $quantity - ($coupons->discount) / 100 * $selling_price * $quantity;
            }
            if(session()->has('coupon')){
                session()->put('totals', $totals);
            } else {
                session()->put('total', $total);
            }
        }
            return view('User.cart.confirm-order', compact( 'totals', 'cart_products', 'total', 'name', 'lname', 'phonenumber', 'email', 'address', 'apartment_address', 'city', 'zipcode', 'user_note'));


    }

    public function placeOrderCashOnDelivery(Request $request)
    {
        $cart_key = Session::get(Cart::$CART_KEY);
        $order_item = Cart::where(Cart::$SESSION_ID_COLUMN, $cart_key)->get();
        foreach($order_item as $item){
            $remaining = $item->product->stock->quantity - $item->quantity;
            $inventoy = Stock::where('id', $item->product->stock->id)->first();
            $inventoy->quantity = $remaining;
            $inventoy->update();
            if($inventoy->quantity <= 5) {
                $product = Product::findOrFail($item->product_id);
                Admin::findOrFail(1)->notify(new NotifyLowQuantity($product));
            }
            if($inventoy->quantity < 1){
                    $product = Product::findOrFail($item->product_id);
                    Admin::findOrFail(1)->notify(new ProductIsOutOfStock($product));
                }
            }
            $fname = session()->get('fname');
            $lname = session()->get('lname');
            $phone = session()->get('phonenumber');
            $email = session()->get('email');
            $address = session()->get('address');
            $address_apartment = session()->get('address_apartment');
            $city = session()->get('city');
            $zipcode = session()->get('zipcode');
            $user_note = session()->get('user_note');
            $order_no = 1;
            $order = new Order();
            $order->fname = $fname;
            $order->lname = $lname;
            $order->phonenumber = $phone;
            $order->email = $email;
            $order->address = $address;
            $order->address_apartment = $address_apartment;
            $order->city = $city;
            $order->zipcode = $zipcode;
            $order->order_no = $order_no;
            $order->user_note = $user_note;
            if(session()->has('coupon')){
               $totals = session()->get('totals');
               $order->paid_price = $totals;
            } else {
               $total = session()->get('total');
                $order->paid_price = $total;
            }
            $order->order_no="PENDINNG";
            if ($user = Auth::user()) {
                $order->user_id = $user->id;
            } else {
                $order->user_id = NULL;
            }
            $order->save();
            foreach ($order_item as $item) {
                $orderItem = new OrderItem();
                $orderItem->quantity = $item->quantity;
                $orderItem->color = $item->color;
                $orderItem->size = $item->size;
                $orderItem->product_name = $item->product->name;
                $orderItem->image = $item->product->images[0]->small_image;
                $orderItem->selling_price = $item->product->selling_price;
                $orderItem->order_id = $order->id;
                $orderItem->payment_method = $request->payment_method;
                $orderItem->save();
            }
        $coupons=Coupon::where('id',session()->get('coupon'))->first();
        if(isset($coupons)) {
            $couponHistory = new CouponHistory();
            $couponHistory->coupon_no = $coupons->coupon_no;
            $couponHistory->discount = $coupons->discount;
            $couponHistory->date = Carbon::Now();
            $couponHistory->user_id = Auth::user()->id;
            $couponHistory->save();
        }
            session()->forget(Cart::$CART_KEY);
            session()->forget('coupon');
        return redirect(route('success',$order->id));
    }

    public function placeOrderCardPayment(Request $request)
    {
        $cart_key = Session::get(Cart::$CART_KEY);
        $order_item = Cart::where(Cart::$SESSION_ID_COLUMN, $cart_key)->get();
        foreach($order_item as $item){
            $remaining = $item->product->stock->quantity - $item->quantity;
            $inventoy = Stock::where('id', $item->product->stock->id)->first();
            $inventoy->quantity = $remaining;
            $inventoy->update();
            if($inventoy->quantity <= 5) {
                $product = Product::findOrFail($item->product_id);
                Admin::findOrFail(1)->notify(new NotifyLowQuantity($product));
            }
            if($inventoy->quantity < 1){
                $product = Product::findOrFail($item->product_id);
                Admin::findOrFail(1)->notify(new ProductIsOutOfStock($product));
            }
        }
//            return $request->all();
        $fname = session()->get('fname');
        $lname = session()->get('lname');
        $phone = session()->get('phonenumber');
        $email = session()->get('email');
        $address = session()->get('address');
        $address_apartment = session()->get('address_apartment');
        $city = session()->get('city');
        $zipcode = session()->get('zipcode');
        $user_note = session()->get('user_note');
        $order_no = 1;
        $order = new Order();
        $order->fname = $fname;
        $order->lname = $lname;
        $order->phonenumber = $phone;
        $order->email = $email;
        $order->address = $address;
        $order->address_apartment = $address_apartment;
        $order->city = $city;
        $order->zipcode = $zipcode;
        $order->order_no = $order_no;
        $order->user_note = $user_note;
        if(session()->has('coupon')){
            $totals = session()->get('totals');
            $order->paid_price = $totals;
        } else {
            $total = session()->get('total');
            $order->paid_price = $total;
        }
        $order->order_no="PENDINNG";
        if ($user = Auth::user()) {
            $order->user_id = $user->id;
        } else {
            $order->user_id = NULL;
        }
        $order->save();
            foreach ($order_item as $item) {
                $orderItem = new OrderItem();
                $orderItem->quantity = $item->quantity;
                $orderItem->color = $item->color;
                $orderItem->size = $item->size;
                $orderItem->product_name = $item->product->name;
                $orderItem->image = $item->product->images[0]->small_image;
                $orderItem->selling_price = $item->product->selling_price;
                $orderItem->order_id = $order->id;
                $orderItem->payment_method = 'paid by card';
                $orderItem->save();
            }
            session()->forget(Cart::$CART_KEY);
        return redirect(route('success', $order->id));

    }

    public function success($id)
    {
//     return 'bello';
        $order = Order::findOrFail($id);
//        Mail::to($order->email)->queue(new OrderSuccessfulMail($order));
        Admin::findOrFail(1)->notify(new OrderSuccessNotification($order));
        return view('User.cart.order-number', compact('order'));
    }






}
