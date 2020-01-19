<?php

namespace Modules\User\Http\Controllers;

use App\Order;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Modules\User\Entities\Address;
use Modules\User\Http\Requests\RegisterUserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function __construct()
    {
        $this->middleware('auth')->except('registerView','register');
    }

    public function registerView()
    {
        return view('User.auth.register');
    }

    public function register(RegisterUserRequest $request)
    {
        $user = new User();
        $user->fname = $request->firstname;
        $user->lname =$request->lastname;
        $user->password = Hash::make($request->password);
        $user->email = $request->email;
        $user->phone_number = $request->number;
        $user->save();
        $request->session()->flash('user_created','Welcome To your new account');
        Auth::login($user);
        return redirect(route('home'));
    }

    public function index($id)
    {
        $user = User::findOrFail($id);
        return view('user::dashboard.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('user::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function shippingDetails($id)
    {
        $user = User::findOrFail($id);
        return view('user::dashboard.shipping',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('user::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }

    public function myOrders()
    {
        $user = Auth::user();
        $order = Order::where('user_id', $user->id)->with('orderItems')->paginate(4);
//        foreach($order as $orders){
//          foreach($orders->orderItems as $item){
//              return $item;
//          }
//        }
        return view('user::dashboard.my-order',compact('user','order'));
    }

    public function updateProfile(Request $request)
    {
//        return $request->all();
        $user = Auth::user();
        $user->fname = $request->fname;
        $user->lname = $request->lname;
        $user->email = $request->email;
        $user->mobile_number = $request->phone_number;
        $user->password = Hash::make($request->password);
        $user->update();
        $request->session()->flash('updated','Your Profile has been Updated');
        return redirect()->back();

    }

    public function addressUpdate(Request $request)
    {
//        return $request->all();
        $user = Auth::user();
        if(isset($user->address)){
            $userAddress = User::findOrFail($user->address->id);
            $userAddress->address = $request->address;
            $userAddress->address_appartment = $request->appartment;
            $userAddress->phone_number = $request->phone;
            $userAddress->zip_code = $request->zipcode;
            $userAddress->city = $request->city;
            $userAddress->user_id = $user->id;
            $userAddress->save();
        } else {
            $address = new Address();
            $address->address = $request->address;
            $address->address_appartment = $request->appartment;
            $address->phone_number = $request->phone;
            $address->zip_code = $request->zipcode;
            $address->city = $request->city;
            $address->user_id = $user->id;
            $address->save();
        }

        $request->session()->flash('updated','Your shipping address has been updated');
        return redirect()->back();
    }
}
