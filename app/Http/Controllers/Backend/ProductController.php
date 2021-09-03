<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\MultiImg;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;

class ProductController extends Controller
{
    public function AddProduct() {
        $categories = Category::latest()->get();
        $brands = Brand::latest()->get();
        return view('backend.product.product_add', compact('categories', 'brands'));
    }

    public function StoreProduct(Request $request) {
        $image = $request->file('product_thumbnail');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(917, 1000)->save('upload/products/thumbnail/'.$name_gen);
        $save_url = 'upload/products/thumbnail/'.$name_gen;
//        insert product and get ID
        $product_id =  Product::insertGetId([
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_id' => $request->subsubcategory_id	,
            'product_name_en' => $request->product_name_en,
            'product_name_vn' => $request->product_name_vn,
            'product_slug_en' => strtolower(str_replace(' ', '-', $request->product_slug_en)),
            'product_slug_vn' => strtolower(str_replace(' ', '-', $request->product_slug_vn)),
            'product_code' => $request->product_code,
            'product_qty' => $request->product_qty,
            'product_tags_en' => $request->product_tags_en,
            'product_tags_vn' => $request->product_tags_vn,
            'product_size_en' => $request->product_size_en,
            'product_size_vn' => $request->product_size_vn,
            'product_color_en' => $request->product_color_en,
            'product_color_vn' => $request->product_color_vn,
            'discount_price' => $request->discount_price,
            'selling_price' => $request->selling_price,
            'short_descp_en' => $request->short_descp_en,
            'short_descp_vn' => $request->short_descp_vn,
            'long_descp_en' => $request->long_descp_en,
            'long_descp_vn' => $request->long_descp_vn,
            'hot_deals' => $request->hot_deals,
            'featured' => $request->featured,
            'special_offer' => $request->special_offer,
            'special_deals' => $request->special_deals,
            'product_thumbnail' => $save_url,
            'status' => 1,
            'created_at' => Carbon::now(),
        ]);

//        Multiple Image Upload Start
        $images = $request->file('multi_img');
        foreach ($images as $image) {
            $make_name = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(917, 1000)->save('upload/products/multi-image/'.$make_name);
            $uploadPath = 'upload/products/multi-image/'.$make_name;
            MultiImg::insert([
                'product_id' => $product_id,
                'photo_name' => $uploadPath,
                'created_at' => Carbon::now(),
            ]);
        }
//        Multiple Image Upload End
        $notification = [
            'message' => 'Product' . $request->product_name_en . ' was inserted successfully',
            'alert-type' => 'success'
        ];
        return redirect()->route('manage-product')->with($notification);
    } // end store product method

    public function ManageProduct() {
        $products = Product::latest()->get();
        return view('backend.product.product_view', compact('products'));
    }
//    display product edit view
    public function EditProduct($id) {
        $brands = Brand::latest()->get();
        $categories = Category::latest()->get();
        $subCategories = SubCategory::latest()->get();
        $subSubCategories = SubSubCategory::latest()->get();
        $product = Product::findOrFail($id);

        return view('backend.product.product_edit', compact('brands', 'categories', 'subCategories', 'subSubCategories', 'product'));
    } // end mange product method

    public function ProductDataUpdate(Request $request) {
        $product_id = $request->id;
        Product::findOrFail($product_id)->update([
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_id' => $request->subsubcategory_id	,
            'product_name_en' => $request->product_name_en,
            'product_name_vn' => $request->product_name_vn,
            'product_slug_en' => strtolower(str_replace(' ', '-', $request->product_slug_en)),
            'product_slug_vn' => strtolower(str_replace(' ', '-', $request->product_slug_vn)),
            'product_code' => $request->product_code,
            'product_qty' => $request->product_qty,
            'product_tags_en' => $request->product_tags_en,
            'product_tags_vn' => $request->product_tags_vn,
            'product_size_en' => $request->product_size_en,
            'product_size_vn' => $request->product_size_vn,
            'product_color_en' => $request->product_color_en,
            'product_color_vn' => $request->product_color_vn,
            'discount_price' => $request->discount_price,
            'selling_price' => $request->selling_price,
            'short_descp_en' => $request->short_descp_en,
            'short_descp_vn' => $request->short_descp_vn,
            'long_descp_en' => $request->long_descp_en,
            'long_descp_vn' => $request->long_descp_vn,
            'hot_deals' => $request->hot_deals,
            'featured' => $request->featured,
            'special_offer' => $request->special_offer,
            'special_deals' => $request->special_deals,
            'status' => 1,
        ]);
        $notification = [
            'message' => 'Product ' . $request->product_name_en . ' Updated Without Images Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('manage-product')->with($notification);
    } // end update method

}
