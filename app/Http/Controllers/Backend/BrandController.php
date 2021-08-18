<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;

class BrandController extends Controller
{
    public function BrandView() {
        $brands = Brand::latest()->get();
        return view('backend.brand.brand_view', compact('brands'));
    }

    public function BrandStore(Request $request) {
        $request->validate([
            'brand_name_en' => 'required',
            'brand_name_vn' => 'required',
            'brand_image' => 'required',
        ], [
            'brand_name_en.required' => 'Input Brand English Name cannot be empty',
            'brand_name_vn.required' => 'Input Brand Vietnames Name cannot be empty',
            'brand_image.required' => 'Input Brand Image cannot be empty',
        ]);

//        image processing
        $image = $request->file('brand_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
//        store image to public folder
        Image::make($image)->resize(300, 300)->save('upload/brand/'.$name_gen);
//       save image path to database
        $save_url = 'upload/brand/'.$name_gen;
        Brand::insert([
            'brand_name_vn' => $request->brand_name_vn,
            'brand_name_en' => $request->brand_name_en,
            'brand_slug_en' => strtolower(str_replace(' ', '-', $request->brand_name_en)),
            'brand_slug_vn' => strtolower(str_replace(' ', '-', $request->brand_name_vn)),
            'brand_image' => $save_url,
            'created_at' => Carbon::now(),
        ]);

        $notification = [
            'message' => 'Brand Inserted Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);


    } // end method
}
