<?php

namespace App\Http\Controllers;

use App\HomeSlider;
use Illuminate\Http\Request;

class WebsiteCongigurationController extends Controller
{


    public function homeSlider(Request $request)
    {
        $slider = HomeSlider::findOrFail($request->id);
        if ($request->exists('image'))
        {
            $thumbnailPath = HomeSlider::UPLOAD_DIRECTORY . '/';
            if (!File::exists($thumbnailPath)) {
                File::makeDirectory($thumbnailPath, $mode = 0777, true, true);
            }
            $file=Input::file('image');
            $path = $file->move($thumbnailPath,str_random(10).$file->getClientOriginalName());
            $slider->image = $path;
        }
        $slider->save();
        return back();
    }
}
