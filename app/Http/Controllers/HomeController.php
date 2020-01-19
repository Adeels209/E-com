<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Contact;
use App\HomeSlider;
use App\Http\Requests\ContactRequest;
use App\Order;
use App\Testimonial;
use App\TestimonialReviews;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Modules\Admin\Entities\Category;
use Modules\Product\Entities\Product;
use Modules\Product\Entities\ProductImages;
use Modules\Product\Entities\ProductSize;
use Modules\Product\Entities\Size;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */



    public function index()
    {
        $banners = HomeSlider::all();
        $testimonialReviews = TestimonialReviews::limit(4)->get();
        $testimonial = Testimonial::all();
        $products = Product::where('is_new_arrival',1)->get();
        $footerProductsNew = Product::where('is_new_arrival',1)->limit(2)->get();
        $featuredProducts = Product::where('is_featured',1)->get();
        $footerProductsFeatured = Product::where('is_featured',1)->limit(2)->get();
        return view('User.index',compact('products','featuredProducts', 'banners', 'testimonial','testimonialReviews','footerProductsNew', 'footerProductsFeatured'));
    }

    public function guestOrder(Request $request)
    {
        $order = Order::where('order_no', $request->order_no)->first();
        if($order == $request->order_no) {
            return view('User.guest-order.my-order', compact('order'));
        } else {
            return back();
        }
    }

    public function allImages(Request $request)
    {
         $product=Product::where('id',$request->id)->with('images')->with('colors')->with('sizes')->with('stock')->first();
         if(isset($product->discount)){
            $discount = $product->selling_price - ($product->discount->discount->discount / 100 * $product->selling_price);
            return Response::json([
                'product'=>$product,
                'discount'=>$discount
            ]);
         } else {
             return Response::json([
                'product'=>$product,
             ]);
         }
    }

    public function subCategoryProducts($slug)
    {
        $category = Category::findBySlugOrFail($slug);
        $products = Product::where('subcategory_id', $category->id)->where('status',1)->paginate(10);
        return view('User.product.sub-category-products', compact('products','category'));
    }

    public function specificProduct($slug)
    {
//        return $slug;
        $product = Product::findBySlugOrFail($slug);
//        return $product->panoramaImages;
//       return $product->images[3]->medium_image;
        $products = Product::where('subcategory_id', $product->subcategory_id)->where('id', '!=', $product->id)->with('images')->limit(5)->get();
        return view('User.product.specific-product', compact('product', 'products'));
    }

    public function categoryProducts($slug)
    {
        $category = Category::findBySlugOrFail($slug);
        $products = Product::where('category_id', $category->id)->where('status',1)->paginate(10);
        return view('User.product.category-products', compact('products','category'));
    }

    public function selectFromPrice(Request $request)
    {
          $bigPrice = str_replace("RS","", $request->startprice);
          $smallPrice = str_replace("RS","", $request->endprice);
          $products = Product::where('selling_price', '>=', $smallPrice )->where('selling_price', '<=', $bigPrice)->get();
         return view('User.product.option-products', compact('products'));

    }

    public function selectFromSize($id)
    {
        $size = Size::where('id', $id)->first();
        return view('User.product.option-products', compact('size'));
    }

    public function shop()
    {
        $categories = Category::where('parent_id','=',NULL)->with('products')->get();
        return view('User.shop',compact('categories'));
    }

    public function search(Request $request)
    {
        if ($request->ajax()) {
            $output = "";
            $products = Product::searchByQuery(array('match_phrase_prefix' => array('name' => $request->search )))->where('status',1);
            if($products) {
                foreach ($products as $key => $product) {
                    $output .=
                        '<a class="mine" href="' . route('specific.product', $product->slug) .'">' . $product->name . '</a>';
                }
                return Response($output);
            }
        }
    }

    public function searchedProducts(Request $request)
    {

        if($request->product_name == Null){
            $request->session()->flash('empty','Your search attempt is empty, Please try again');
            return redirect(route('home'));
        } else {
            $products = Product::searchByQuery(array('match_phrase_prefix' => array('name' => $request->product_name)));
            if ($products->isEmpty()) {
//                return 'now i am here and going back';
                $request->session()->flash('nothing', 'Your search does not match anything');
               return redirect(route('home'));
            } else {
                return view('User.product.searched-product', compact('products'));
            }
        }

    }

    public function show_key_val($key, $value)
    {

    }

    public function productThree60View(Request $request)
    {
        $product = Product::findBySlugOrFail($request->slug);
        $productImages = $product->panoramaImages->pluck('image')->all();
        return response()->json(['status'=>200, 'images'=>$productImages]);
    }

    public function contact()
    {
        return view('User.contact');
    }

    public function contactSave(ContactRequest $request)
    {
//        return $request->all();
        $contact = new Contact();
        $contact->name = $request->name;
        $contact->subject = $request->subject;
        $contact->email = $request->email;
        $contact->description = $request->message;
        $contact->save();
        $request->session()->flash('mail_sent','We have received your email we will get back to you within 24 Hours ');
        return back();
    }

    public function about()
    {
        return view('User.about');
    }
    public function admin()
    {
        return view('Admin.index');
    }

    public function xmlProducts(Request $request)
    {
        $products = Product::all();
        $xml = new \DOMDocument('1.0');
        $xml->formatOutput= true;
        $userXml = $xml->createElement('xml');
        $xml->appendChild($userXml);
        foreach ($products as $product) {
            $userXmlData = $xml->createElement('product_catalogue');
            $userXml->appendChild($userXmlData);

            $name = $xml->createElement("name",$product->name);
            $userXmlData->appendChild($name);

            $cost_price = $xml->createElement("cost_price",$product->cost_price);
            $userXmlData->appendChild($cost_price);

            $selling_price = $xml->createElement("selling_price",$product->selling_price);
            $userXmlData->appendChild($selling_price);

            $description = $xml->createElement("description",strip_tags($product->long_description));
            $userXmlData->appendChild($description);
        }
        $request->session()->flash('product_report','Product catalogue xml file has been saved in xml named directory of this project');
        $xml->save('C:/xampp/htdocs/specom/xml/product_catalogue.xml');
        return redirect(route('admin.dashboard'));
    }

    public function xmlOrders(Request $request)
    {
        $orders = Order::all();
        $xml = new \DOMDocument('1.0');
        $xml->formatOutput= true;
        $userXml = $xml->createElement('xml');
        $xml->appendChild($userXml);
        foreach ($orders as $order) {
            $userXmlData = $xml->createElement('product_catalogue');
            $userXml->appendChild($userXmlData);

            nl2br('////');

            $name = $xml->createElement("first_name",$order->fname);
            $userXmlData->appendChild($name);
            nl2br('////');

            $lname = $xml->createElement("last_name",$order->lname);
            $userXmlData->appendChild($lname);
            nl2br('////');

            $cost_price = $xml->createElement("order_number",$order->order_no);
            $userXmlData->appendChild($cost_price);
            nl2br('////');

            $paid_price = $xml->createElement("paid_price",$order->paid_price);
            $userXmlData->appendChild($paid_price);
            nl2br('////');

            $email = $xml->createElement("email",strip_tags($order->email));
            $userXmlData->appendChild($email);

            foreach ($order->orderItems as $orderItem) {
                $productName = $xml->createElement("product_name",$orderItem->product_name);
                $userXmlData->appendChild($productName);
                nl2br('////');

                $productSellingPrice = $xml->createElement("selling_price", $orderItem->selling_price);
                $userXmlData->appendChild($productSellingPrice);
                nl2br('////');

                $purchasedQuantity = $xml->createElement("purchased_quantity",$orderItem->quantity);
                $userXmlData->appendChild($purchasedQuantity);
                
                $paymentMethod = $xml->createElement("payment_method",$orderItem->payment_method);
                $userXmlData->appendChild($paymentMethod);
            }
        }
        $request->session()->flash('orders_report','Order xml file has been saved in xml named directory of this project');
        $xml->save('C:/xampp/htdocs/specom/xml/order_report.xml');
        return redirect(route('admin.dashboard'));
    }

}
