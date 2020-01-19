<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Admin\Entities\Category;
use Modules\Admin\Http\Requests\CategoryRequest;
use Modules\Admin\Http\Requests\CreateCategoryRequest;
use Modules\Product\Entities\Product;

class AdminCategoriesController extends Controller
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
        $categories = Category::where('parent_id',NULL)->get();
        return view('admin::category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin::.category.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(CategoryRequest $request)
    {
//        return $request->all();
        $category = new Category();
        $category->name = $request->name;
        $category->description = $request->description;
            if ($file = $request->file('image')) {
                $name = time() . $file->getClientOriginalName();
                $path = $file->move('category_image', $name);
                $category->image = $path;
        }
            $category->save();
            $request->session()->flash('category_created','Category has been created');
            return redirect(route('admin.category.index'));
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
        $category = Category::findOrFail($id);
        $categories = Category::where('id','!=',$category->id)->get();
        return view('admin::category.edit', compact('category','categories'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->name = $request->name;
        $category->description = $request->description;
        if ($file = $request->file('image')) {
            if (file_exists($filename = public_path() .'/'. $category->image)) {
                unlink($filename);
            }
            $name = time() . $file->getClientOriginalName();
            $path = $file->move('category_image', $name);
            $category->image = $path;

        }
        $category->save();
        $request->session()->flash('category_updated','Category has been updated');
        return redirect(route('admin.category.index'));
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(Request $request)
    {
        $category = Category::where('id',$request->id)->first();
        if(isset($category->image)){
            unlink(public_path() .'/'. $category->image);
        }
        if(count($category->childCategory) > 0) {
            if($category->products){
                foreach($category->products as $product){
                     $product->category_id = NULL;
                     $product->subcategory_id = NULL;
                     $product->save();
                }
            }
            foreach($category->childCategory as $child) {
                $child->delete();
            }

        }
           if($category->delete()){
               return response()->json(['status'=>200]);
           } else {
               return response()->json(['status'=>-1]);
           }



    }//

}
