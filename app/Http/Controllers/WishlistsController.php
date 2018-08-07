<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Wishlist;
use Auth;

class WishlistsController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // for guests that are not logged in as admin.
        // Except for logout method.
        $this->middleware('auth');
    }

    public function index(){
        $wishlists = Auth::user()->wishlist()->paginate(10);
        return view('wishlist.index',[
            'wishlists' => $wishlists
        ]);
    }
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
                'message' => 'Product already exists in the wishlist!'
            ]);
        }

        return response()
            ->json([
                'message' => 'Product added to wishlist'
            ]);
    }

    public function destroy($id){
        $wishlist = Wishlist::destroy($id);
        
        return redirect()
            ->back()
            ->with('status','Wishlist item has been deleted!');
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
