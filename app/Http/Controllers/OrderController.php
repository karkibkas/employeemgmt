<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Address;
use App\Product;
use Auth;
use Cart;

class OrderController extends Controller
{
    /**
     *  NOTICE!
     *  We are Using User model for Customer.
     */

    /**
     * Manage Customer Orders
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validate the Request
        $this->validateOrder($request);
        
        //If not Authenticated.
        $this->notAuthenticated();

        //create or get the first customer address.
        $address = $this->firstOrCreateAddress($request);
        
        //create a unique hash.
        $hash = bin2hex(random_bytes(32));

        //create the order.
        $order = $this->createOrder($hash,$address->id);

        //get the Cart products.
        $items = Cart::content();

        //get the cart products as eloquent models.
        $products = $this->getCartProducts($items);

        //get the cart products quantities.
        $quantities = $this->getQuantities($items);
        
        /**
         * Single order can have multiple products
         * so, we are storing the products (product_id)
         * and its quantites in orders_products table 
         * associate with single order with order_id.
         */
        $order->products()->saveMany(
            $products,
            $quantities
        );

        //Empty the Cart
        Cart::destroy();

        return redirect()
            ->route('cart.index')
            ->with('status','Your order has been placed!');        

    }

    /**
     *  Validate the Request
     * 
     *  @param \Illuminate\Http\Request $request
     *  @return void
     */
    private function validateOrder(Request $request){
        $this->validate($request,[
            'address_1'    =>  'required|string|min:7|max:255',
            'address_2'    =>  'nullable|string|min:7|max:255',
            'city'         =>  'required|min:3|max:50',
            'postal_code'  =>  'required|min:3|max:50',
        ]);
    }

    /**
     * Return First or Create an address for Customer (user)
     * in the database.
     * 
     *  @param \Illuminate\Http\Request $request
     *  @return App\Address
     */
    private function firstOrCreateAddress(Request $request){
        return Address::firstOrCreate([
                'address_1' => $request->address_1,
                'address_2' => $request->address_2,
                'city' => $request->city,
                'postal_code' => $request->postal_code
            ]);
    }

    /**
     *  store customer order in the database
     * 
     *  @param string $hash
     *  @param int $address_id
     *  @return App\Order
     */
    private function createOrder($hash,$address_id){
        return Auth::user()->orders()->create([
            'hash' => $hash,
            'paid' => false,
            'total' => Cart::total(),
            'address_id' => $address_id,
        ]);
    }

    /**
     * get all the products quantities from 
     * the cart.
     * @param \Cart $items
     */
    private function getQuantities($items){
        $qty = [];
        foreach($items as $item){
            $qty[] = ['qty' => $item->qty]; 
        }

        return $qty;
    }

    /**
     * get all the product models associated
     * with the cart
     * 
     * @param \Cart $items
     * @return App\Product $products[]
     */
    private function getCartProducts($items){
        $products = [];

        foreach($items as $item){
            $products[] = Product::where('slug',$item->id)->first();
        }

        return $products;
    }

    /**
     *  If a User is Not logged in
     * 
     *  @return \Illuminate\Http\Response
     */
    private function notAuthenticated(){
        if(!Auth::check()){
            return redirect()
                ->route('cart.index')
                ->with('status', 'Please Login to Checkout!');
        }
    }
}
