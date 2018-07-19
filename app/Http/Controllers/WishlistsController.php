<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Wishlist;
use Auth;

class WishlistsController extends Controller
{

    /**
     *  Store a wishlist product to storage.
     * 
     *  @param \Illuminate\Http\Request $request
     *  @return \Illuminate\Http\Response
     */
    public function store(Request $request){

        if(!Auth::check()){
            return response()
            ->json([
                'msg' => 'Please Login/Register to use Wishlist!'
            ]);
        }
    
        $product = Product::findOrFail($request->_id);

        $p_id = $product->id;

        $result = $this->createWishlist($p_id);
        
        //Product Already Exists
        if(!$result->wasRecentlyCreated){
            return response()
            ->json([
                'msg' => 'Product already exists in the wishlist!'
            ]);
        }

        return response()
            ->json([
                'msg' => 'Product added to wishlist'
            ]);
    }

    /**
     * Retrieve the first matching wishlist item or
     * create one.
     * 
     * @param int $p_id
     * @return App\Wishlist
     */
    private function createWishlist($p_id){
        return Wishlist::firstOrCreate([
            'product_id' => $p_id,
            'user_id' => Auth::id()
        ]);
    }
}
