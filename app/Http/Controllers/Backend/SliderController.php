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

    public function editSlider($id) {
        $sliderToEdit = Slider::findOrFail($id);
        return view('backend.slider.slider_edit', compact('sliderToEdit'));
    }

    public function updateSlider(Request $request) {
        $sliderId = $request->id;
        $oldImage = $request->old_image;
        $imgToUpdate = $request->file('slider_img');
        if ($imgToUpdate) {
//            delete old image
            unlink($oldImage);
            $name_gen = hexdec(uniqid()).'.'.$imgToUpdate->getClientOriginalExtension();
            Image::make($imgToUpdate)->resize(870, 370)->save('upload/slider/'.$name_gen);
            $save_url = 'upload/slider/'.$name_gen;
            Slider::find($sliderId)->update([
                'title' => $request->title,
                'description' => $request->description,
                'slider_img' => $save_url,
            ]);
        } else {
            Slider::find($sliderId)->update([
                'title' => $request->title,
                'description' => $request->description,
            ]);
        } // end else
        $notification = [
            'message' => 'Slider Updated Successfully',
            'alert-type' => 'info'
        ];
        return redirect()->route('manage.slider')->with($notification);
    } // end updateSlider method
}
