<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\MultiImg;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductDetailsController extends Controller
{
    public function showDetails($productToShowId, $slug) {
        $product = Product::findOrFail($productToShowId);
//        access product color and return an array of its colors
        $color_en = $product->product_color_en;
        $product_color_en = explode(',', $color_en);

        $color_vn = $product->product_color_vn;
        $product_color_vn = explode(',', $color_vn);

//      access product size and return an array of its sizes
        $size_en = $product->product_size_en;
        $product_size_en = explode(',', $size_en);

        $size_vn = $product->product_size_vn;
        $product_size_vn = explode(',', $size_vn);

        $multiImg = MultiImg::where('product_id', '=', $productToShowId)->get();

        $product_category_id = $product->category_id;
        $relatedProducts = Product::where('category_id', $product_category_id)->where('id', '!=', $productToShowId)->orderBy('id', 'DESC')->get();
        return view('frontend.product.product_details', compact('product', 'multiImg', 'product_color_en',
            'product_color_vn',  'product_size_en', 'product_size_vn', 'relatedProducts'));
    }
}
