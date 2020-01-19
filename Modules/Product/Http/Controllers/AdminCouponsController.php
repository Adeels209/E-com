<?php

namespace Modules\Product\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Product\Entities\Coupon;
use Modules\Product\Http\Requests\CouponRequest;
use Modules\Product\Http\Requests\CreateCouponRequest;

class AdminCouponsController extends Controller
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
        $coupons = Coupon::all();
        return view('product::coupon.index', compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('product::coupon.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(CreateCouponRequest $request)
    {
//        return $request->all();
        $coupon = new Coupon();
        $coupon->coupon_name = $request->coupon_name;
        $coupon->discount = $request->discount;
        $coupon->coupon_no = $request->coupon_no;
        if ($file = $request->file('image')) {
            $name = time() . $file->getClientOriginalName();
            $path = $file->move('discount_image', $name);
            $coupon->image = $path;
        }
        $coupon->save();
        $request->session()->flash('coupon_created','Coupon Has been created');
        return redirect(route('admin.coupon.index'));
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('product::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
        $coupon = Coupon::findOrFail($id);
        return view('product::coupon.edit', compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(CouponRequest $request, $id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->coupon_name = $request->coupon_name;
        $coupon->discount = $request->discount;
        $coupon->coupon_no = $request->coupon_no;
        if ($file = $request->file('image')) {
            if (file_exists($filename = public_path() .'/'. $coupon->image)) {
                unlink($filename);
            }
            $name = time() . $file->getClientOriginalName();
            $path = $file->move('coupon_images', $name);
            $coupon->image = $path;

        }
        $coupon->save();
        $request->session()->flash('coupon_updated','Discount Has been updated');
        return redirect(route('admin.discount.index'));
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(Request $request)
    {
        $coupon = Coupon::findOrFail($request->id);
        if($coupon->delete()){
            if(isset($coupon->image)){
                unlink(public_path() .'/'. $coupon->image);
            }
            return response()->json(['status'=>200]);
        } else {
            return response()->json(['status'=>-1]);
        }
    }
}
