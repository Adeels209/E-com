<?php

namespace Modules\Product\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Product\Entities\Size;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $sizes =  Size::all();
        return view('product::size.index', compact('sizes'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('product::size.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        Size::create($input);
        $request->session()->flash('size_created','Size has been created');
        return redirect('admin/size/index');
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
        $size = Size::findOrFail($id);
        return view('product::edit', compact('size'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request,$id)
    {
        $input = $request->all();
        $size = Size::findOrFail($id);
        $size->update($input);
        $request->session()->flash('size_updated','Size has been updated');
        return redirect('admin/size/index');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(Request $request)
    {
        $size = Size::findOrFail($request->id);
        if($size->delete()){
            return response()->json(['status'=>200]);
        } else {
            return response()->json(['status'=>-1]);
        }
    }
}
