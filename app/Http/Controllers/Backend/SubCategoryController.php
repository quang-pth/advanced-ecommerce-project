<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function SubCategoryView() {
        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        $subCategories = SubCategory::latest()->get();
        return view('backend.category.subcategory_view', compact('categories' , 'subCategories'));
    }

    public function SubCategoryStore(Request $request) {
        $request->validate([
            'category_id' => 'required',
            'subcategory_name_en' => 'required',
            'subcategory_name_vn' => 'required',
        ], [
            'category_id.required' => 'Please select a category option',
            'subcategory_name_en.required' => 'Input Category English Name cannot be empty',
            'subcategory_name_vn.required' => 'Input Category Vietnamese Name cannot be empty',
        ]);

        SubCategory::insert([
            'category_id' => $request->category_id,
            'subcategory_name_en' => $request->subcategory_name_en,
            'subcategory_name_vn' => $request->subcategory_name_vn,
            'subcategory_slug_en' => strtolower(str_replace(' ', '-', $request->subcategory_name_en)),
            'subcategory_slug_vn' => strtolower(str_replace(' ', '-', $request->subcategory_name_vn)),
            'created_at' => Carbon::now(),
        ]);

        $notification = [
            'message' => 'Add ' . $request->subcategory_name_en. ' Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    } // end method

    protected function SubCategoryEdit($id) {
        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        $subCategory = SubCategory::findOrFail($id);
        return view('backend.category.subcategory_edit', compact('categories' , 'subCategory'));
    }

    public function SubCategoryUpdate(Request $request) {
        $request->validate([
            'category_id' => 'required',
            'subcategory_name_en' => 'required',
            'subcategory_name_vn' => 'required',
        ], [
            'category_id.required' => 'Please select a category option',
            'subcategory_name_en.required' => 'Input Sub-category English Name cannot be empty',
            'subcategory_name_vn.required' => 'Input Sub-category Vietnamese Name cannot be empty',
        ]);
        $subcatId = $request->id;
        $catToUpdateName = SubCategory::find($subcatId)->subcategory_name_en;
        SubCategory::findOrFail($subcatId)->update([
            'category_id' => $request->category_id,
            'subcategory_name_en' => $request->subcategory_name_en,
            'subcategory_name_vn' => $request->subcategory_name_vn,
            'subcategory_slug_en' => strtolower(str_replace(' ', '-', $request->subcategory_name_en)),
            'subcategory_slug_vn' => strtolower(str_replace(' ', '-', $request->subcategory_name_vn)),
            'created_at' => Carbon::now(),
        ]);

        $notification = [
            'message' => 'Update ' . $catToUpdateName . ' Successfully',
            'alert-type' => 'info'
        ];

        return redirect()->route('all.subcategory')->with($notification);
    } // end update method


}
