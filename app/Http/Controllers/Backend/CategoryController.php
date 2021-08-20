<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function CategoryView() {
        $categories = Category::latest()->get();
        return view('backend.category.category_view', compact('categories'));
    }

}
