<?php

namespace App\Http\Controllers\Backend;

use App\Actions\Jetstream\DeleteTeam;
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
            'brand_name_en' => $request->brand_name_en,
            'brand_name_vn' => $request->brand_name_vn,
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

    public function BrandEdit($id) {
        $brand = Brand::findOrFail($id);
        return view('backend.brand.brand_edit', compact('brand'));
    }

    public function BrandUpdate(Request $request) {
        $request->validate([
            'brand_name_en' => 'required',
            'brand_name_vn' => 'required',
             ], [
            'brand_name_en.required' => 'Input Brand English Name cannot be empty',
            'brand_name_vn.required' => 'Input Brand Vietnames Name cannot be empty',
        ]);
        $brandId = $request->id;
        $oldImage = $request->old_image;
        if ($request->file('brand_image')) {
//            delete old image
            unlink($oldImage);
            $image = $request->file('brand_image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(300, 300)->save('upload/brand/'.$name_gen);
            $save_url = 'upload/brand/'.$name_gen;
            Brand::find($brandId)->update([
                'brand_name_en' => $request->brand_name_en,
                'brand_name_vn' => $request->brand_name_vn,
                'brand_slug_en' => strtolower(str_replace(' ', '-', $request->brand_name_en)),
                'brand_slug_vn' => strtolower(str_replace(' ', '-', $request->brand_name_vn)),
                'brand_image' => $save_url,
                'created_at' => Carbon::now(),
            ]);
        } else {
            Brand::find($brandId)->update([
                'brand_name_en' => $request->brand_name_en,
                'brand_name_vn' => $request->brand_name_vn,
                'brand_slug_en' => strtolower(str_replace(' ', '-', $request->brand_name_en)),
                'brand_slug_vn' => strtolower(str_replace(' ', '-', $request->brand_name_vn)),
                'created_at' => Carbon::now(),
            ]);
        } // end else
        $notification = [
            'message' => 'Brand Updated Successfully',
            'alert-type' => 'info'
        ];
        return redirect()->route('all.brand')->with($notification);
    } // end method

    public function BrandDelete($id) {
        $brand = Brand::findOrFail($id);
        $img = $brand->brand_image;
        unlink($img);
        Brand::findOrFail($id)->delete();
        $notification = [
            'message' => 'Brand Deleted Successfully',
            'alert-type' => 'info'
        ];
        return redirect()->back()->with($notification);
    }
}
