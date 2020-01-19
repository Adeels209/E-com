<?php

namespace Modules\Product\Http\Controllers;

use App\PanoramaImages;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Modules\Admin\Entities\Brand;
use Modules\Admin\Entities\Category;
use Modules\Product\Entities\Color;
use Modules\Product\Entities\ColorProduct;
use Modules\Product\Entities\Discount;
use Modules\Product\Entities\DiscountProduct;
use Modules\Product\Entities\Product;
use Modules\Product\Entities\ProductImages;
use Modules\Product\Entities\ProductSize;
use Modules\Product\Entities\Size;
use Modules\Product\Http\Requests\ProductRequest;

class AdminProductsController extends Controller
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
        $products = Product::with('category')->get();
        return view('product::addproduct.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $categories = Category::whereNull('parent_id')->get();
        $sizes = Size::all();
        $colors = Color::all();
        $brands= Brand::all();
        return view('product::addproduct.create',compact('brands','categories','sizes','colors'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(ProductRequest $request)
    {
        $product = new Product();
        $product->name = $request->product_name;
        $product->cost_price = $request->cprice;
        $product->selling_price = $request->sprice;
        $product->status = $request->status;
        $product->long_description = $request->longdescription;
        $product->short_description = $request->shortdescription;
        $product->subcategory_id = $request->subcategory_id;
        $subcategory_id = Category::where('id',$request->subcategory_id)->first();
        $product->category_id = $subcategory_id->parentCategory->id;
        $product->brand_id = $request->brand_id;
        if($request->status == 'on'){
            $product->status = '1';
        } else {
            $product->status = '0';
        }
        if($request->is_featured == 'on'){
            $product->is_featured = '1';
        } else {
            $product->is_featured = '0';
        }
        if($request->is_new_arrival == 'on'){
            $product->is_new_arrival = '1';
        } else {
            $product->is_new_arrival = '0';
        }
        $product->save();
        foreach($request->color_id as $id){
            $productcolor = new ColorProduct();
            $productcolor->color_id = $id;
            $productcolor->product_id = $product->id;
            $productcolor->save();
        }
        foreach($request->size_id as $id){
            $productsize = new ProductSize();
            $productsize->size_id = $id;
            $productsize->product_id = $product->id;
            $productsize->save();
        }
        $request->session()->flash('product_created','Your Product has been published');
//        Product::deleteIndex();
//        Product::addAllToIndex();
        return redirect('admin/product/index');
    }

    public function productMedia($slug)
    {
        $product = Product::findBySlugOrFail($slug);
        return view('product::media.index',compact('product'));
    }

    public function productMediaStore(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        if(count($product->images) > 3 ){
            return response()->json(['status'=>-200]);
        }
        if ($file = $request->file('file')) {
            foreach ($file as $originalImage) {
                $productImage = new ProductImages();
                $thumbnailImage = Image::make($originalImage);
                $thumbnailPath = 'productimages/' . $product->slug . '/';
                if (!File::exists($thumbnailPath)) {
                    File::makeDirectory($thumbnailPath, $mode = 0777, true, true);
                }

                $originalimage = str_random(60) . '_.' . $originalImage->getClientOriginalExtension();
                $thumbnailImage->save($thumbnailPath . $originalimage);

                $thumbnailImage->resize(null,390, function($constraint){
                    $constraint->aspectRatio();
                });
                $small_image = str_random(60) . '_.' . $originalImage->getClientOriginalExtension();
                $thumbnailImage->save($thumbnailPath . $small_image);

                $thumbnailImage->resize(217,null, function($constraint){
                    $constraint->aspectRatio();
                });
                $large_image = str_random(60) . '_.' . $originalImage->getClientOriginalExtension();
                $thumbnailImage->save($thumbnailPath . $large_image);

                $thumbnailImage->resize(170, null, function($constraint){
                    $constraint->aspectRatio();
                });
                $display_name = str_random(60) . '_.' . $originalImage->getClientOriginalExtension();
                $thumbnailImage->save($thumbnailPath . $display_name);

                $productImage->product_id = $product->id;
                $productImage->large_image = $thumbnailPath . $small_image;
                $productImage->medium_image = $thumbnailPath . $large_image;
                $productImage->small_image = $thumbnailPath . $display_name;
                $productImage->original_image = $thumbnailPath . $originalimage;
                $productImage->save();
                if ($productImage) {
                    return response()->json([
                        'status' => 'Your product',
                        'product_Image' => $productImage,

                    ]);
                } else {
                    return response()->json([
                        'status' => -1,

                    ]);
                }
            }

        }
     }


    public function panoramaView($slug)
    {
        $product = Product::findBySlugOrFail($slug);
        return view('product::media.panorama',compact('product'));
    }


    public function productPanaramaImages(Request $request)
    {
//        return $request->all();
        $product = Product::findOrFail($request->product_id);
        if ($file = $request->file('file')) {
            foreach ($file as $originalImage) {
                $productImage = new PanoramaImages();
                $productImage->product_id = $request->product_id;
                $thumbnailImage = Image::make($originalImage);
                $thumbnailPath = 'productpanoramaimages/' . $product->slug . '/';
                if (!File::exists($thumbnailPath)) {
                    File::makeDirectory($thumbnailPath, $mode = 0777, true, true);
                }
                $originalimage = str_random(60) . '_.' . $originalImage->getClientOriginalExtension();
                $thumbnailImage->save($thumbnailPath . $originalimage);

                $thumbnailImage->resize(null,458, function($constraint){
                    $constraint->aspectRatio();
                });
                $large_image = str_random(60) . '_.' . $originalImage->getClientOriginalExtension();
                $thumbnailImage->save($thumbnailPath . $large_image);

                $thumbnailImage->resize(458, 458);
                $productImage->image = $thumbnailPath . $large_image;
                $productImage->save();
                if ($productImage) {
                    return response()->json([
                        'status' => 'Your product',
                        'product_Image' => $productImage,

                    ]);
                } else {
                    return response()->json([
                        'status' => -1,

                    ]);
                }
            }

        }
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
    public function edit($slug)
    {
        $product = Product::findBySlugOrFail($slug);
//        return $product->category;
        $product_subcategory = Category::where('id', $product->subcategory_id)->first();
        $categories = Category::whereNull('parent_id')->get();
//        return $product->colors;
        $sizes = Size::all();
        $colors = Color::all();
        $brands= Brand::all();
        return view('product::addproduct.edit',compact('product','categories','sizes','colors','brands','product_subcategory'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(ProductRequest $request, $slug)
    {

       $product = Product::findBySlugOrFail($slug);
        $product->name = $request->product_name;
        $product->cost_price = $request->cprice;
        $product->selling_price = $request->sprice;
        $product->status = $request->status;
        $product->long_description = $request->longdescription;
        $product->short_description = $request->shortdescription;
        $product->subcategory_id = $request->subcategory_id;
        $subcategory_id = Category::where('id',$request->subcategory_id)->first();
        $product->category_id = $subcategory_id->parentCategory->id ;
        $product->brand_id = $request->brand_id;
        if($request->status == 'on'){
            $product->status = '1';
        } else {
            $product->status = '0';
        }
        if($request->is_featured == 'on'){
            $product->is_featured = '1';
        } else {
            $product->is_featured = '0';
        }
        if($request->is_new_arrival == 'on'){
            $product->is_new_arrival = '1';
        } else {
            $product->is_new_arrival = '0';
        }
        $product->save();
        $product->colors()->sync($request->color_id);
        $product->sizes()->sync($request->size_id);
        $request->session()->flash('product_updated','Your Product has been updated');
//        Product::deleteIndex();
//        Product::addAllToIndex();
        return redirect('admin/product/index');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */

    public function destroy(Request $request)
    {
        $product = Product::findOrFail($request->id);
        if(count($product->images) > 0){
            foreach($product->images as $image) {
                if (isset($image)) {
                    File::delete($image->small_image, $image->medium_image, $image->large_image);
                    $image->delete();
                    }
                }
            }
            if(isset($product)){
                $product->delete();
                Product::deleteIndex();
                Product::addAllToIndex();
                $product->colors()->detach();
                $product->sizes()->detach();
                if(isset($product->dicount)) {
                    $product->discount->delete();
                }
                return response()->json(['status'=>200]);
            } else {
                response()->json(['status'=>-1]);
            }
    }


    public function mediaDestroy(Request $request)
    {
        $image = ProductImages::findOrFail($request->id);
        if(isset($image)){
            File::delete($image->small_image, $image->medium_image, $image->large_image);
            $image->delete();
            return response()->json(['status'=>200]);
        } else {
            return response()->json(['status'=>-1]);
        }


    }

    public function mediaPanoramaDestroy(Request $request)
    {
        $image = PanoramaImages::findOrFail($request->id);
        if(isset($image)){
            File::delete($image->image);
            $image->delete();
            return response()->json(['status'=>200]);
        } else {
            return response()->json(['status'=>-1]);
        }


    }

    public function discountAllProducts()
    {
        $discounts = Discount::all();
        $products = Product::all();
//        foreach($products as $product){
//            return $product->discount;
//        }
        return view('product::product-discount.index', compact('discounts','products'));
    }


    public function applyDiscount(Request $request)
    {
        foreach($request->product_id as $id){
            $productExists = DiscountProduct::where('product_id', $id)->first();
            if(isset($productExists)){
                $request->session()->flash('discount_exists', 'Discount for these Products already exists');
                return back();
            } else {
                $discountProduct = new DiscountProduct();
                $discountProduct->product_id = $id;
                $discountProduct->discount_id = $request->discount_id;
                $request->session()->flash("product_discount",'Discount is applied to the products');
                $discountProduct->save();
            }
        }
        return redirect(route('admin.discount.all'));
    }

    public function removeDiscount(Request $request)
    {
        $discounrProduct = DiscountProduct::findOrFail($request->id);
        if($discounrProduct->delete()){
            return response()->json(['status'=>200]);
        } else {
            return response()->json(['status'=>-1]);
        }
    }

}
