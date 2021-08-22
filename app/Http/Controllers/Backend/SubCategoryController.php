<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use Carbon\Carbon;
use Illuminate\Http\Client\Events\RequestSending;
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

    public function SubCategoryDelete($id) {
        $catToDeleteName = SubCategory::find($id)->subcategory_name_en;
        SubCategory::findOrFail($id)->delete();
        $notification = [
            'message' => 'Delete ' . $catToDeleteName . ' Successfully',
            'alert-type' => 'info'
        ];
        return redirect()->back()->with($notification);
    }

//    Functions for SubSubCategory
    public function SubSubCategoryView() {
        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        $subSubCategories = SubSubCategory::latest()->get();
        return view('backend.category.sub_subcategory_view', compact('categories' , 'subSubCategories'));
    }

    public function GetSubCategory($category_id) {
        $subCategories = SubCategory::where('category_id', '=', $category_id)->orderBy('subcategory_name_en', 'ASC')->get();
        return json_encode($subCategories);
    }

    public function SubSubCategoryStore(Request $request) {
        $request->validate([
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'subsubcategory_name_en' => 'required',
            'subsubcategory_name_vn' => 'required',
        ], [
            'category_id.required' => 'Please select a category option',
            'subcategory_id.required' => 'Please select a sub-category option',
            'subcategory_name_en.required' => 'Input Category English Name cannot be empty',
            'subcategory_name_vn.required' => 'Input Category Vietnamese Name cannot be empty',
        ]);

        SubSubCategory::insert([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_name_en' => $request->subsubcategory_name_en,
            'subsubcategory_name_vn' => $request->subsubcategory_name_vn,
            'subsubcategory_slug_en' => strtolower(str_replace(' ', '-', $request->subsubcategory_name_en)),
            'subsubcategory_slug_vn' => strtolower(str_replace(' ', '-', $request->subsubcategory_name_vn)),
            'created_at' => Carbon::now(),
        ]);

        $notification = [
            'message' => 'Add ' . $request->subsubcategory_name_en. ' Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }


}
