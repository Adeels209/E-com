<?php

namespace Modules\Product\Http\Controllers;

use App\Notifications\NotifyLowQuantity;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Product\Entities\Product;
use Modules\Product\Entities\Stock;
use Modules\Product\Http\Requests\CreateStockRequest;

class AdminProductStocksController extends Controller
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
        $stocks = Stock::all();
        return view('product::stock.index', compact('stocks'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $products = Product::all();
        return view('product::stock.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(CreateStockRequest $request)
    {
//        return $request->all();
        $stockExists = Stock::where('product_id', $request->product_id)->first();
        if(isset($stockExists)){
            $request->session()->flash('stock_exists', 'Stock already exists for this product');
            return redirect(route('admin.stock.index'));
        } else {
//            return 'hello';
            $stock = new Stock();
            $stock->quantity =  $request->quantity;
            $stock->product_id = $request->product_id;
            $stock->save();
        }
        $request->session()->flash('stock_created','Product stock has been updated');
        return redirect(route('admin.stock.index'));
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
        $stock = Stock::findOrFail($id);
        return view('product::stock.edit', compact('stock'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(CreateStockRequest $request, $id)
    {
//        return $request->all();
        $stock = Stock::findOrFail($id);
        $stock->quantity = $request->quantity;
        $stock->product_id = $request->product_id;
        $stock->update();
        $request->session()->flash('stock_updated','Product stock has been updated');
        return redirect(route('admin.stock.index'));
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(Request $request)
    {
        $stock = Stock::findOrFail($request->id);
        if($stock->delete()){
            return response()->json(['status'=>200]);
        } else {
            return response()->json(['status'=>-1]);
        }
    }

    public function checkStock($id)
    {
        Auth::guard('admin')->user()->notifications->where('id',$id)->markAsRead();
        $notification = Auth::guard('admin')->user()->notifications->where('id',$id)->first();
        $product = Product::where('id', $notification->data['product']['id'])->first();
        $productStock = Stock::where('id', $product->stock->id)->first();
        return redirect(route('admin.stock.edit', $productStock->id));
    }
}
