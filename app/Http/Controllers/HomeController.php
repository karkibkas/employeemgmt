<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Auth;

class HomeController extends Controller
{
    /**
     * Display Index Page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home.index');
    }

    /**
     * Display Products Page
     *
     * @return \Illuminate\Http\Response
     */
    public function products()
    {
        $products = Product::orderBy('created_at')->paginate(20);
        
        return view('home.products',[
          'products' => $products
        ]);
    }

    /**
     * Display a Single Product
     *
     * @param string $slug
     * @return \Illuminate\Http\Response
     */
    public function showProduct($slug)
    {
        $product = Product::where('slug',$slug)->first();
        return view('home.product-details',[
            'product' => $product
        ]);
    }

    /**
     * Display About Page.
     *
     * @return \Illuminate\Http\Response
     */
    public function about()
    {
        return view('home.about');
    }

    /**
     * Display Contact Page.
     *
     * @return \Illuminate\Http\Response
     */
    public function contact()
    {
        return view('home.contact');
    }

    /**
     * Display Cart Page.
     *
     * @return \Illuminate\Http\Response
     */
    public function cart()
    {
        //dd(\Cart::content());
        return view('home.cart');
    }

    /**
     *  Display Checkout/Order Page
     *  @return \Illuminate\Http\Response
     */
    public function checkout(){
        if(!Auth::check()){
            return redirect()
                ->route('login')
                ->with('status','Please Login or Register to Place the Order!');
        }

        if(!\Cart::count()){
            return redirect()->route('cart.index');
        }

        return view('home.checkout');
    }
}
