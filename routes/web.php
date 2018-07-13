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

/**
 *  Basic Routes
 */
Route::get('/', 'HomeController@index')->name('index');
Route::get('/products', 'HomeController@products')->name('products');
Route::get('/products/{slug}','HomeController@showProduct')->name('product-details');
Route::get('/contact', 'HomeController@contact')->name('contact');
Route::get('/about', 'HomeController@about')->name('about');
Route::get('/checkout', 'HomeController@checkout')->name('checkout');

/**
 *  prefixing routes and grouping them together.
 */
Route::prefix('/cart')->name('cart.')->group(function(){
    Route::get('/', 'HomeController@cart')->name('index');
    Route::post('/add','CartController@addCart');
    Route::post('/update','CartController@updateCart');
});

// Generate Authentication routes for Users
Auth::routes();

// Admin Route(s)
Route::prefix('/admin')->name('admin.')->namespace('Admin')->group(function(){
    /**
     *  Authentication Route(s)
     */
    Route::namespace('Auth')->group(function(){  
        Route::get('/login', 'LoginController@showLoginForm')->name('login');
        Route::post('/login','LoginController@login');
        Route::post('/logout', 'LoginController@logout')->name('logout');
        Route::get('/register', 'RegisterController@showRegisterationForm')->name('register');
        Route::post('/register', 'RegisterController@register');
        Route::post('/password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
        Route::get('/password/reset','ResetPasswordController@showLinkRequestForm')->name('password.request');
        Route::post('/password/reset', 'ResetPasswordController@reset');
        Route::get('/password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
    });

    /**
     *  Dashboard Route(s)
     */
    Route::get('/dashboard' , 'DashboardController@index')->name('dashboard');

    /**
     *  Product Route(s)
     */
    Route::resource('/products', 'ProductsController');
});