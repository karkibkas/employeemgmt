<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

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
     * @return \Illuminate\Http\Response
     */
    public function showProduct($slug)
    {
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
        return view('home.cart');
    }
}
