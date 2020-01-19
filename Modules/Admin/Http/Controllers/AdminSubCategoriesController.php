<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Admin\Entities\Category;
//use Modules\Admin\Entities\CategorySubCategory;
use Modules\Admin\Entities\SubCategory;
use Modules\Admin\Http\Requests\CreateSubCategoryRequest;
use Modules\Product\Entities\Product;

class AdminSubCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */

    public $parent_id = '0';

    public function __construct()
    {
        $this->middleware(['auth:admin', 'isAdmin']);
    }


    public function index()
    {
        $categories = Category::where('parent_id','!=',NULL)->get();
//        foreach($categories as $category){
//            foreach($category->childCategory as $child){
////                return $child->id;
//                return $product = Product::where('subcategory_id',$child->id)->first();
//            }
//        }
        return view('admin::sub-category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $categories = Category::where('parent_id',NULL)->get();
        return view('admin::sub-category.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(CreateSubCategoryRequest $request)
    {
//        return $request->all();
        $subCategory = new Category();
        $subCategory->name        = $request->name;
        $subCategory->description = $request->description;
        if ($file = $request->file('image')) {
            $name = time() . $file->getClientOriginalName();
            $path = $file->move('subCategory_image', $name);
            $subCategory->image = $path;
        }
        if(isset($request->parent_id)){
            $subCategory->parent_id = $request->parent_id;

        } else {
            $subCategory->parent_id = NULL;
        }
        $subCategory->save();
        $request->session()->flash('subcategory_submitted', ' Sub-Category has been Published.');
        return redirect(route('admin.sub-category.index'));
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
        $categoryy = Category::with('parentCategory')->findOrFail($id);
//        return $categoryy->parentCategory;
        $categories  = Category::where('parent_id',NULL)->get();
        return view('admin::sub-category.edit',compact('categoryy','categories'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $subcategory = Category::findOrFail($id);
        $input = $request->all();
        if ($file = $request->file('image')) {
            if (file_exists($filename = public_path() . "/" . $subcategory->image)) {
                $name = time() . $file->getClientOriginalName();
                $path = $file->move('photos', $name);
                $input['image'] = $path;
            }
        }
        if(isset($request->parent_id)){
            $subcategory->parent_id = $request->parent_id;
        } else {
            $subcategory->parent_id = NULL;
        }
        $subcategory->update($input);
        $request->session()->flash('subcategory_updated', ' Sub-Category has been Updated.');
        return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(Request $request)
    {
        $subcategory = Category::where('id',$request->id)->first();
        if($subcategory){
            if($subcategory->productss){
                foreach($subcategory->productss as $product) {
                    $product->subcategory_id = NULL;
                    $product->save();
                }
            }
            $subcategory->delete();
            return response()->json(['status'=>200]);
        } else {
            return response()->json(['status'=>-1]);
        }
    }
}
