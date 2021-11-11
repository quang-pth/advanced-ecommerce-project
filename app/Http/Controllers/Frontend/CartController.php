<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Wishlist;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function AddToCart(Request $request, $id) {
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
        Cart::remove($rowId);
        return response()->json([
            'success' => 'Product Removed From Cart'
        ]);
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

}
