<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

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

}
