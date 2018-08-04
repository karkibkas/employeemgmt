<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Review;
use App\Product;
use App\User;

class ReviewsController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reviews = Review::orderBy('created_at','desc')->paginate(10);
        return view('admin.reviews.index',[
            'reviews' => $reviews,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $review = Review::findOrFail($id);
        $users = User::all();
        $products = Product::all();
        return view('admin.reviews.edit',[
            'review' => $review,
            'users' => $users,
            'products' => $products,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validateRequest($request);

        $this->updateReview($request, $id);

        return redirect()
            ->route('admin.reviews.index')
            ->with('status','Selected review has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $review = Review::destroy($id);
        return redirect()
        ->back()
        ->with('status','Selected review has been deleted!');
    }

    /**
     * Validate the Request
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    private function validateRequest(Request $request){
        $this->validate($request,[
            'user'        => 'required|integer|min:1',
            'product'     => 'required|integer|min:1',
            'description' => 'required|string|min:20',
            'rating'      => 'required|between:1,5',
            'status'      => 'required|boolean'
        ]);
    }

    /**
     * Update Review
     * 
     * @param \Illuminate\Http\Request $request
     * @return void
     */
    private function updateReview(Request $request,$id){
        $review = Review::findOrFail($id);
        $review->user_id = $request->user;
        $review->product_id = $request->product;
        $review->text = $request->description;
        $review->rating = $request->rating;
        $review->status = $request->status;
        $review->save();
    }
}
