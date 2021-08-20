<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function SubCategoryView() {
        $subCategories = SubCategory::latest()->get();
        return view('backend.category.subcategory_view', compact('subCategories'));
    }
}
