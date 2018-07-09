<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;
use App\Product;

class CartController extends Controller
{
    /**
     * Add Item to Cart
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addCart(Request $request){
        $id = $request->_id ;
        $qty = $request->_qty ;
        $product = Product::findOrFail($id);

        //Add item to Cart
        Cart::add(
            $product->slug,
            $product->title,
            $qty,
            $product->price
        );
        return response()->json([
            'success'     =>  true,
            'cart_count'  =>  Cart::count(),
            'msg'         =>  'Your Item has been added to Cart!'
        ]);
    }

    /**
     * Update/Remove Item from Cart
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateCart(Request $request){
        //return response()->json(['success' => 'ok']);
        $qty = $request->_qty;
        $id = $request->_rowId;
        
        // if user selects none then, remove that item from cart.
        if($qty == 0){
            Cart::remove($id);
            return response()->json([
                'success'     =>  true,
                'type'        =>  'delete',
                'cart_count'  =>  Cart::count(),
                'total'       =>  Cart::total(),
                'tax'         =>  Cart::tax(),
                'subtotal'    =>  Cart::subtotal(),
                'msg'         => 'Your selected item has been removed from cart!'
            ]);
        }

        Cart::update($id,$qty);
        return response()->json([
            'success'     =>  true,
            'cart_count'  =>  Cart::count(),
            'total'       =>  Cart::total(),
            'tax'         =>  Cart::tax(),
            'subtotal'    =>  Cart::subtotal(),
            'msg'         =>  'Your item quantity has been updated!'
        ]);
    }
}
