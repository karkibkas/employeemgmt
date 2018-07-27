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

/**
 *  Checkout Route(s)
 */
Route::prefix('checkout')->group(function(){
    Route::get('/', 'HomeController@checkout')->name('checkout');
    Route::post('/','OrderController@store');
});

/**
 *  Customer (User) Profile Route(s)
 */
Route::prefix('/profile')->group(function(){
    Route::get('/','ProfileController@show')->name('profile');
    Route::post('/','ProfileController@update');
});

/**
 *  Customer order history Route(s)
 */
Route::get('/order/history','OrderController@index')->name('order.index');
Route::get('/order/history/{id}','OrderController@show')->name('order.show');

// get the braintree client token
Route::get('/braintree/token','BraintreeController@token');

/**
 *  Customer Wishlist Route(s)
 */
Route::prefix('wishlist')->name('wishlist.')->group(function(){
    Route::post('/add', 'WishlistsController@store')->name('add');
    Route::get('/','WishlistsController@index')->name('index');
    Route::delete('/{id}','WishlistsController@destroy')->name('destroy');
});


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
        Route::get('/password/reset','ForgotPasswordController@showLinkRequestForm')->name('password.request');
        Route::post('/password/reset', 'ResetPasswordController@reset');
        Route::get('/password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
    });

    /**
     *  Dashboard Route(s)
     */
    Route::get('/dashboard' , 'DashboardController@index')->name('dashboard');

    /**
     *  Admin Profile
     */
    Route::get('/dashboard/profile','ProfileController@show')->name('profile');
    Route::post('/dashboard/profile','ProfileController@update');

    /**
     *  Product Route(s)
     */
    Route::resource('/products', 'ProductsController');

    /**
     *  Categories Route(s)
     */
    Route::resource('/categories', 'CategoriesController');

    /**
     *  Orders Route(s)
     */
    Route::resource('/orders','OrdersController');

    /**
     *  Payments Route(s)
     */
    Route::resource('/payments','PaymentsController');

    /**
     *  Customers (Users) Route(s)
     */
    Route::resource('/customers','CustomersController');

    /**
     *  Addresses Route(s)
     */
    Route::resource('/addresses','AddressesController');
});
