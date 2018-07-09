<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index')->name('index');
Route::get('/products', 'HomeController@products')->name('products');
Route::get('/products/{slug}','HomeController@showProduct')->name('product-details');
Route::get('/contact', 'HomeController@contact')->name('contact');
Route::get('/about', 'HomeController@about')->name('about');
Route::get('/checkout', 'HomeController@checkout')->name('checkout');

Route::prefix('/cart')->group(function(){
    Route::get('/', 'HomeController@cart')->name('cart');
    Route::post('/add','CartController@addCart');
    Route::post('/update','CartController@updateCart');    
});