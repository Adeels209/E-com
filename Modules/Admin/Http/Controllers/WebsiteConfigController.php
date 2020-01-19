<?php

namespace Modules\Admin\Http\Controllers;

use App\HomeSlider;
use App\SiteSettings;
use App\Testimonial;
use App\TestimonialReviews;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\URL;
use Modules\Product\Entities\Product;

class WebsiteConfigController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */

    public function __construct()
    {
        $this->middleware(['auth:admin', 'isAdmin']);
    }

    public function testimonialIndex()
    {
        $testimonial = Testimonial::all();
        return view('admin::WebsiteConfiguration.Testimonials.index', compact('testimonial'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $sliders = HomeSlider::all();
        return view('admin::WebsiteConfiguration.HomeSliders.create', compact('sliders'));
    }

    public function testimonialUpdate(Request $request)
    {
        $testimonial = Testimonial::findOrFail($request->id);
        $testimonial->title = $request->title;
        if ($file = $request->file('image')) {
            if (file_exists($filename = public_path() .'/'. $testimonial->image)) {
                unlink($filename);
            }
            $name = time() . $file->getClientOriginalName();
            $path = $file->move('brand_image', $name);
            $testimonial->image = $path;
        }
        $testimonial->update();
        return redirect()->back();
    }

    public function sliderStore(Request $request, $id)
    {
        $slider = HomeSlider::findOrFail($id);
        $slider->title = $request->title;
        $slider->subtitle = $request->subtitle;
        if ($request->exists('image'))
        {
            $thumbnailPath = HomeSlider::UPLOAD_DIRECTORY . '/';
            if (!File::exists($thumbnailPath)) {
                File::makeDirectory($thumbnailPath, $mode = 0777, true, true);
            }
            $file=Input::file('image');
            $path = $file->move($thumbnailPath,str_random(10) . $file->getClientOriginalName());
            $slider->image = $path;
        }
        $slider->save();
        return back();
    }


    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function testimonialReviewsIndex()
    {
        $testimonialreviews = TestimonialReviews::all();
        return view('admin::WebsiteConfiguration.TestimonialsReviews.index', compact('testimonialreviews'));
    }

    public function testimonialReviewsStore(Request $request)
    {

        $testimonialreviews = new TestimonialReviews();
        $testimonialreviews->name = $request->name;
        $testimonialreviews->review = $request->review_text;
        if ($request->exists('image'))
        {
            $thumbnailPath = TestimonialReviews::UPLOAD_DIRECTORY . '/';
            if (!File::exists($thumbnailPath)) {
                File::makeDirectory($thumbnailPath, $mode = 0777, true, true);
            }
            $file=Input::file('image');
            $path = $file->move($thumbnailPath,str_random(10).$file->getClientOriginalName());
            $testimonialreviews->image = $path;
        }
        $testimonialreviews->save();

        return redirect()->back();
    }

    public function testimonialReviewsUpdate(Request $request)
    {
        $testimonialreviews = TestimonialReviews::findOrFail($request->id_edit);
        $testimonialreviews->name = $request->name;
        $testimonialreviews->review = $request->review_edit;
        if ($request->exists('image'))
        {
            $thumbnailPath = TestimonialReviews::UPLOAD_DIRECTORY . '/';
            if (!File::exists($thumbnailPath)) {
                File::makeDirectory($thumbnailPath, $mode = 0777, true, true);
            }
            $file=Input::file('image');
            $path = $file->move($thumbnailPath,str_random(10).$file->getClientOriginalName());
            $testimonialreviews->image = $path;
        }
        $testimonialreviews->save();
        return redirect()->back();
    }

    public function testimonialsReviewsDestroy($id) {
        $testimonialreviews = TestimonialReviews::findOrFail($id);
        $testimonialreviews->delete();
        return redirect()->back();
    }

    public function siteSettingsView()
    {
        $productFeatured = Product::where('is_featured',1)->get();
        $productSale = Product::where('is_new_arrival',1)->get();
        $siteSettings = SiteSettings::all();
        return view('admin::WebsiteConfiguration.SiteSettings.index', compact('siteSettings', 'productFeatured', 'productSale'));
    }

    public function siteSettingsUpdate(Request $request){
//        return $request->all();
        $siteSettings = SiteSettings::findOrFail($request->id);
        $siteSettings->facebook_link = $request->facebook_link;
        $siteSettings->twitter_link = $request->twitter_link;
        $siteSettings->instagram_link = $request->instagram_link;
        $siteSettings->email = $request->email;
        $siteSettings->phonenumber = $request->phonenumber;
//        $siteSettings->sale_one = $request->sale_one;
//        $siteSettings->sale_two = $request->sale_two;
//        $siteSettings->is_featured_one = $request->is_featured_one;
//        $siteSettings->is_featured_two = $request->is_featured_two;
        if ($request->exists('logo_header')) {
            $thumbnailPath = SiteSettings::UPLOAD_DIRECTORY . '/';

            if (!File::exists($thumbnailPath)) {
                File::makeDirectory($thumbnailPath, $mode = 0777, true, true);
            }

            $file=Input::file('logo_header');
            $path = $file->move($thumbnailPath,str_random(10).$file->getClientOriginalName());
            $siteSettings->logo_header = $path;
        }

        if ($request->exists('logo_footer')) {
            $thumbnailPath = SiteSettings::UPLOAD_DIRECTORY . '/';

            if (!File::exists($thumbnailPath)) {
                File::makeDirectory($thumbnailPath, $mode = 0777, true, true);
            }

            $file=Input::file('logo_footer');
            $path = $file->move($thumbnailPath,str_random(10).$file->getClientOriginalName());
            $siteSettings->logo_footer = $path;
        }

        $siteSettings->update();
        return redirect()->back();
    }

    public function store(Request $request)
    {
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
}
