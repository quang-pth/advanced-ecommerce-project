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
            'message' => 'Add ' . $request->category_name_en. ' Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    } // end method

    public function CategoryEdit($id) {
        $category = Category::findOrFail($id);
        return view('backend.category.category_edit', compact('category'));
    }

    public function CategoryUpdate(Request $request) {
        $request->validate([
            'category_name_en' => 'required',
            'category_name_vn' => 'required',
            'category_icon' => 'required',
        ], [
            'category_name_en.required' => 'Input Category English Name cannot be empty',
            'category_name_vn.required' => 'Input Category Vietnamese Name cannot be empty',
            'category_icon.required' => 'Input Category Image cannot be empty',
        ]);
        $categoryId = $request->id;
        $categoryName = Category::find($categoryId)->category_name_en;
        Category::find($categoryId)->update([
            'category_name_en' => $request->category_name_en,
            'category_name_vn' => $request->category_name_vn,
            'category_slug_en' => strtolower(str_replace(' ', '-', $request->category_name_en)),
            'category_slug_vn' => strtolower(str_replace(' ', '-', $request->category_name_vn)),
            'category_icon' => $request->category_icon,
            'created_at' => Carbon::now(),
        ]);
        $notification = [
            'message' => 'Update ' . $categoryName . ' Successfully',
            'alert-type' => 'success'
        ];
        return redirect()->route('all.category')->with($notification);
    } // end update method

    public function CategoryDelete($id) {
        $categoryName = Category::find($id)->category_name_en;
        Category::find($id)->delete();
        $notification = [
            'message' => 'Delete ' . $categoryName . ' Successfully',
            'alert-type' => 'success'
        ];
        return redirect()->back()->with($notification);
    }

}
