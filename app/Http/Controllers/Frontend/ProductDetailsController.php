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
        $multiImg = MultiImg::where('product_id', '=', $productToShowId)->get();
        return view('frontend.product.product_details', compact('product', 'multiImg'));
    }
}
