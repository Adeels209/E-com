<?php

namespace Modules\Admin\Http\Controllers;

use App\Mail\OrderStatusChangeMail;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AdminOrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function __construct()
    {
        $this->middleware(['auth:admin', 'isAdmin']);
    }

    public function index()
    {
        $orders = Order::all();
        return view('admin::order.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {

        return view('admin::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        foreach($request->order_id_checked as $id){
            $order = Order::findOrFail($id);
            $order->status = $request->select;
            $order->update();
//            Mail::to($order->email)->queue(new OrderStatusChangeMail($order));
        }
        return back();
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('admin::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('admin::edit');
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

    public function orderCheck($id)
    {
        Auth::guard('admin')->user()->unreadNotifications->where('id',$id)->markAsRead();
        return redirect(route('admin.order.index'));
    }


}
