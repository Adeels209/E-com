<?php

namespace Modules\Product\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Product\Entities\Discount;
use Modules\Product\Http\Requests\CreateDiscountRequest;
use Modules\Product\Http\Requests\DiscountRequest;

class AdminDiscountsController extends Controller
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
        $discounts = Discount::all();
        return view('product::discount.index', compact('discounts'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('product::discount.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(CreateDiscountRequest $request)
    {
        $discount = new Discount();
        $discount->discount_name = $request->discount_name;
        $discount->discount = $request->discount;
        $discount->start_date =  $request->start_date;
        $discount->end_date =  $request->end_date;
        if ($file = $request->file('image')) {
            $name = time() . $file->getClientOriginalName();
            $path = $file->move('discount_image', $name);
            $discount->image = $path;
        }
        $discount->save();
        $request->session()->flash('discount_created','Discount Has been created');
        return redirect(route('admin.discount.index'));
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
        $discount = Discount::findOrFail($id);
        return view('product::discount.edit', compact('discount'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(DiscountRequest $request, $id)
    {
//        return $request->all();
        $discount = Discount::findOrFail($id);
        $discount->discount_name = $request->discount_name;
        $discount->discount = $request->discount;
        $discount->start_date =  $request->start_date;
        $discount->end_date =  $request->end_date;
        if ($file = $request->file('image')) {
            if (file_exists($filename = public_path() .'/'. $discount->image)) {
                unlink($filename);
            }
            $name = time() . $file->getClientOriginalName();
            $path = $file->move('discount_image', $name);
            $discount->image = $path;

        }
        $discount->save();
        $request->session()->flash('discount_updated','Discount Has been updated');
        return redirect(route('admin.discount.index'));
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(Request $request)
    {
        $discount = Discount::findOrFail($request->id);
        if($discount->delete()){
            if(isset($discount->image)){
                unlink(public_path() .'/'. $discount->image);
            }
            return response()->json(['status'=>200]);
        } else {
            return response()->json(['status'=>-1]);
        }
    }
}
