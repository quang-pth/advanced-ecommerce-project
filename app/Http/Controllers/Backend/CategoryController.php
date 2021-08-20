<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Carbon\Carbon;
use Carbon\Traits\Test;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function CategoryView() {
        $categories = Category::latest()->get();
        return view('backend.category.category_view', compact('categories'));
    }

    public function CategoryStore(Request $request) {
        $request->validate([
            'category_name_en' => 'required',
            'category_name_vn' => 'required',
            'category_icon' => 'required',
        ], [
            'category_name_en.required' => 'Input Category English Name cannot be empty',
            'category_name_vn.required' => 'Input Category Vietnamese Name cannot be empty',
            'category_icon.required' => 'Input Category Image cannot be empty',
        ]);

        Category::insert([
            'category_name_en' => $request->category_name_en,
            'category_name_vn' => $request->category_name_vn,
            'category_slug_en' => strtolower(str_replace(' ', '-', $request->category_name_en)),
            'category_slug_vn' => strtolower(str_replace(' ', '-', $request->category_name_vn)),
            'category_icon' => $request->category_icon,
            'created_at' => Carbon::now(),
        ]);

        $notification = [
            'message' => 'Brand Inserted Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    } // end method

}
