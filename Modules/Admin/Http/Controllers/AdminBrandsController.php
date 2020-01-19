<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Admin\Entities\Brand;
use Modules\Admin\Http\Requests\CreateBrandsRequest;

class AdminBrandsController extends Controller
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
        $brands = Brand::all();
        return view('admin::brand.index',compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('admin::brand.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(CreateBrandsRequest $request)
    {
//        return $request->all();
        $brand = new Brand();
        $brand->name = $request->name;
        $brand->description = $request->description;
        if($file = $request->file('image')){
            $name = time() . $file->getClientOriginalName();
            $path = $file->move('brand_image', $name);
            $brand->path = $path;
        }
        $brand->save();
        $request->session()->flash('brand_created','Brand has been created');
        return redirect('admin/brand/index');
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
    public function edit($id)
    {
        $brand = Brand::findOrFail($id);
        return view('admin::brand.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request,$id)
    {
        $brand = Brand::findOrFail($id);
        $brand->name = $request->name;
        $brand->description = $request->description;
        if ($file = $request->file('image')) {
            if (file_exists($filename = public_path() .'/'. $brand->image)) {
                unlink($filename);
            }
            $name = time() . $file->getClientOriginalName();
            $path = $file->move('brand_image', $name);
            $brand->image = $path;

        }
        $brand->update();
        $request->session()->flash('brand_updated','Brand has been updated');
        return redirect('admin/brand/index');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(Request $request)
    {
        $brand = Brand::findOrFail($request->id);
        if($brand->delete()){
            return response()->json(['status'=>200]);
        } else {
            return response()->json(['status'=>-1]);
        }
    }
}
