<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class IndexController extends Controller
{
    public function index() {
        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        define('LIMIT_SLIDERS', 3);
        $sliders = Slider::where('status', '=', 1)->orderBy('id', 'DESC')->limit(LIMIT_SLIDERS)->get();
        $products = Product::where('status', '=', 1)->orderBy('id', 'DESC')->get();
//        show featured products
        $featuredProducts = Product::where('featured', '=', 1)->orderBy('id', 'DESC')->get();
        $hotDealsProducts = Product::where('hot_deals', '=', 1)->where('discount_price', '!=', NULL)->orderBy('id', 'DESC')->get();
        $specialOfferProducts = Product::where('special_offer', '=', 1)->orderBy('id', 'DESC')->get();
        $specialDealProducts = Product::where('special_deals', '=', 1)->orderBy('id', 'DESC')->get();

        $categorizedProducts =  $this->categorizeProduct();
//      display second brand products
        $skipBrand1 = Brand::skip(1)->first();
        $skipBrandProduct1 = Product::where('status', '=', 1)->where('brand_id', '=', $skipBrand1->id)->orderBy('id', 'DESC')->get();

        return view('frontend.index', compact('categories', 'sliders', 'products',
            'featuredProducts', 'hotDealsProducts', 'specialOfferProducts', 'specialDealProducts', 'categorizedProducts', 'skipBrand1', 'skipBrandProduct1'
        ));
    }

    public function categorizeProduct() {
        $categoryCounts = count(Category::get());
        $categorizedProducts = [];
        for($idx = 0; $idx < $categoryCounts; $idx++) {
            $product = Category::skip($idx)->first()->product->where('status', 1)->sortDesc();
             array_push($categorizedProducts, $product);
        }
        return $categorizedProducts;
    }

    public function UserLogout() {
        Auth::logout();
        return redirect()->route('login');
    }

    public function UserProfile() {
        $userId = Auth::user()->id;
        $user = User::find($userId);
        return view('frontend.profile.user_profile', compact('user'));
    }

    public function UserProfileStore(Request $request) {
        $data = User::find(Auth::user()->id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
//        store image
        if ($request->file('profile_photo_path')) {
            $file = $request->file('profile_photo_path');
            if (User::find(Auth::user()->id)->profile_photo_path) {
                @unlink(public_path('upload/user_images/'.$data->profile_photo_path));
            }
            $filename = date('YmdHi').$file->getClientOriginalExtension();
//            upload file to public folder
            $file->move(public_path('upload/user_images'), $filename);
            $data['profile_photo_path'] = $filename;
        }
//
        $data->save();
//        add toaster notification message
        $notification = array(
            'message' => 'User Profile Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('dashboard')->with($notification);
    }

    public function UserChangePassword() {
        $userId = Auth::user()->id;
        $user = User::find($userId);
        return view('frontend.profile.change_password', compact('user'));
    }

    public function UserPasswordUpdate(Request $request) {
        $validateData = $request->validate([
            'oldpassword' => 'required',
            'password' => 'required|confirmed|',
        ]); // end method

        $hashedOldPassword = Auth::user()->password;
        if(Hash::check($request->oldpassword, $hashedOldPassword)) {
            $user = User::find(Auth::user()->id);
            $user->password = Hash::make($request->password);
            $user->save();
//            log out admin after change password successfully
            Auth::logout();
//            add toaster notification
            return redirect()->route('user.logout');
        } else {
            $notification = [
                'message' => 'Password Not Update Successfully',
                'alert-type' => 'warning'
            ];
            return redirect()->back()->with($notification);
        }
    }

    public function TagWiseProduct($tag) {
        $products = Product::where('status', 1)->where('product_tags_en', $tag)->orWhere('product_tags_vn', $tag)->orderBy('id', 'DESC')->paginate(3);
        $categories = Category::orderBy('category_name_en', 'DESC')->get();
        return view('frontend.tags.tags_view', compact('products', 'categories'));
    }
}
