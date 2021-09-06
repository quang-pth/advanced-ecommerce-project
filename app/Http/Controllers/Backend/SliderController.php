<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;

class SliderController extends Controller
{
    public function viewSlider() {
        $sliders = Slider::latest()->get();
        return view('backend.slider.slider_view', compact('sliders'));

    }
}
