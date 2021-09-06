<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;

class SliderController extends Controller
{
    public function viewSlider() {
        $sliders = Slider::latest()->get();
        return view('backend.slider.slider_view', compact('sliders'));

    }

    public function storeSlider(Request $request) {
        $request->validate([
            'slider_img' => 'required'
        ], [
            'slider_img.required' => 'Please Select One Image',
        ]);
        $image = $request->file('slider_img');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(870, 370)->save('upload/slider/'.$name_gen);
        $save_url = 'upload/slider/'.$name_gen;
        Slider::insert([
            'title' => $request->title,
            'description' => $request->description,
            'slider_img' => $save_url,
            'created_at' => Carbon::now(),
        ]);

        $notification = [
            'message' => 'Slider Inserted Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    } // end storeSlider method
}
