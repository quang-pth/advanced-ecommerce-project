<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Session;

class CartPageController extends Controller
{
    public function MyCart() {
        return view('frontend.wishlist.view_mycart');
    }

    public function GetCartProduct() {
        $carts = Cart::content();
        $cartQty = Cart::count(); // total numbers of items in cart
        $cartTotal = Cart::total(); // total of all items (price && quantity)
        return response()->json(array(
            'carts' => $carts,
            'cartQty' => $cartQty,
            'cartTotal' => $cartTotal,
        ));
    } // end GetCardProduct

    public function RemoveCartProduct($rowId) {
        try {
            Cart::remove($rowId);

            if(Session::has('coupon')) {
                Session::forget('coupon');
            }

            return response()->json(['success' => 'Successully Remove From Cart']);
        } catch(Exception $exception) {
            return response()->json(['error' => 'Not Valid Cart ID']);
        }
    } // end RemoveCartProduct

    public function CartIncrement($rowId) {
        try {
            $cartToUpdate = Cart::get($rowId);
            Cart::update($rowId, $cartToUpdate->qty + 1);
            if(Session::has('coupon')) {
                $coupon_name = Session::get('coupon')['coupon_name'];
                $coupon = Coupon::where('coupon_name', $coupon_name)->first();

                Session::put('coupon', [
                    'coupon_name' => $coupon->coupon_name,
                    'coupon_discount' => $coupon->coupon_discount,
                    'discount_amount' => round(Cart::total() * intval($coupon->coupon_discount) / 100),
                    'total_amount' => round(Cart::total() - (Cart::total() * intval($coupon->coupon_discount) / 100)),
                ]);
            }

            return response()->json(['increment']);
        } catch(Exception $exception) {
            return response()->json(['error' => 'Quantity Not Increasing Failed']);
        }
    } // end Cart Increment

    public function CartDecrement($rowId) {
        try {
            $cartToUpdate = Cart::get($rowId);
            Cart::update($rowId, $cartToUpdate->qty - 1);
            if(Session::has('coupon')) {
                $coupon_name = Session::get('coupon')['coupon_name'];
                $coupon = Coupon::where('coupon_name', $coupon_name)->first();

                Session::put('coupon', [
                    'coupon_name' => $coupon->coupon_name,
                    'coupon_discount' => $coupon->coupon_discount,
                    'discount_amount' => round(Cart::total() * intval($coupon->coupon_discount) / 100),
                    'total_amount' => round(Cart::total() - (Cart::total() * intval($coupon->coupon_discount) / 100)),
                ]);
            }
            return response()->json(['increment']);
        } catch(Exception $exception) {
            return response()->json(['error' => 'Quantity Not Increasing Failed']);
        }
    } // end Cart Decrement

}
