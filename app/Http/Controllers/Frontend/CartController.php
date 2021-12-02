<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\Wishlist;
use Carbon\Carbon;
use Dflydev\DotAccessData\Data;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function AddToCart(Request $request, $id) {
        if(Session::has('coupon')) {
            Session::forget('coupon');
        }

        $product = Product::findOrFail($id);
        if ($product->discount_price == NULL) {
            $cart = Cart::add([
                'id' => $id,
                'name' => $request->product_name,
                'qty' => intval($request->quantity),
                'price' => $product->selling_price,
                'weight' => 1,
                'options' => [
                    'image' => $product->product_thumbnail,
                    'color' => $request->color,
                    'size' => $request->size,
                ]
            ]);
        } else {
            $cart = Cart::add([
                'id' => $id,
                'name' => $request->product_name,
                'qty' => intval($request->quantity),
                'price' => $product->discount_price,
                'weight' => 1,
                'options' => [
                    'image' => $product->product_thumbnail,
                    'color' => $request->color,
                    'size' => $request->size,
                    'slug' => strtolower(str_replace(' ', '-', $request->product_name)),
                ]
            ]);
        }

        return response()->json([
            'success' => 'Successfully Added on Your cart',
        ]);
    } // end AddToCart method

    public function GetMiniCart() {
        $carts = Cart::content();
        $cartQty = Cart::count(); // total numbers of items in cart
        $cartTotal = Cart::total(); // total of all items (price && quantity)

        return response()->json(array(
            'carts' => $carts,
            'cartQty' => $cartQty,
            'cartTotal' => $cartTotal,
        ));
    } // end GetMiniCart

    public function RemoveMiniCart($rowId) {
        try {
            Cart::remove($rowId);
            return response()->json(['success' => 'Successully Remove From Cart']);
        } catch(Exception $exception) {
            return response()->json(['error' => 'Not Valid Cart ID']);
        }
    } // end RemoveMiniCart

    public function AddToWishlist(Request $request, $product_id) {
        if (Auth::check()) {
            $exists = Wishlist::where('user_id', Auth::id())->where('product_id', $product_id)->first();

            if (!$exists) {
                Wishlist::insert([
                    'user_id' => Auth::id(),
                    'product_id' => $product_id,
                    'created_at' => Carbon::now(),
                ]);
                return response()->json(['success' => 'Add to your wishlist successfully']);
            } else {
                return response()->json(['error' => 'This product has already on your wishlist']);
            }
        } else {
            return response()->json(['error' => 'At fist login your account']);
        }

    } // end AddToWishlist method

    public function CouponApply(Request $request) {
        $coupon = Coupon::where('coupon_name', $request->coupon_name)->where('coupon_validity', '>=', Carbon::now()->format('Y-m-d'))->first();
        if ($coupon) {
            Session::put('coupon', [
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => round(intval(Cart::total()) * intval($coupon->coupon_discount) / 100),
                'total_amount' => round(intval(Cart::total()) - (intval(Cart::total()) * intval($coupon->coupon_discount) / 100)),
            ]);
            return response()->json(array(
                'success' => 'Coupon applied successfully',
            ));
        } else {
            return response()->json(['error' => 'Invalid Coupon or Coupon was expired']);
        }
    } // end CouponApply method

    public function CouponCalculation() {
        if (Session::has('coupon')) {
            return response()->json(array(
                'subtotal' => Cart::total(),
                'coupon_name' => session()->get('coupon')['coupon_name'],
                'coupon_discount' => session()->get('coupon')['coupon_discount'],
                'discount_amount' => session()->get('coupon')['discount_amount'],
                'total_amount' => session()->get('coupon')['total_amount'],
            ));
        } else {
            return response()->json(array(
                'total' => Cart::total(),
            ));
        }

    } // end CouponCalculation

    public function CouponRemove() {
        Session::forget('coupon');
        return response()->json([
            'success' => 'Coupon Removed Successfully'
        ]);
    }

    public function CheckoutCreate() {
        if (Auth::check()) {
            if (Cart::total() > 0) {
                $carts = Cart::content();
                $cartQty = Cart::count();
                $cartTotal = Cart::total();

                return view('frontend.checkout.checkout_view', compact('carts', 'cartQty', 'cartTotal'));
            } else {
                $notification = array(
                    'message' => 'Shopping at least one product',
                    'alert-type' => 'error'
                );

                return redirect()->to('/')->with($notification);
            }

        } else {
            $notification = array(
                'message' => 'You need to Login first',
                'alert-type' => 'error'
            );

            return redirect()->route('login')->with($notification);
        }

    } // end CheckoutCreate method

}
