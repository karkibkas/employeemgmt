<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;

class CategoriesController extends Controller
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
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('created_at')->paginate(10);
        return view('admin.categories.index',[
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateCategory($request);
        $category = new Category();
        $this->createOrUpdateCategory($category,$request);
        return redirect()
            ->route('admin.categories.index')
            ->with('status', 'Category Created!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit',[
            'category' => $category
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
        $this->validateCategory($request);
        $category = Category::findOrFail($id);
        $this->createOrUpdateCategory($category,$request);
        return redirect()
            ->route('admin.categories.index')
            ->with('status', 'Category Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()
            ->route('admin.categories.index')
            ->with('status','Selected Category has been deleted!');
    }

    /**
     *  Validate the Category Request
     * 
     *  @param \Illuminate\Http\Request $request
     *  @return void
     */
    private function validateCategory(Request $request){
        $this->validate($request,[
            'title' => 'required|min:5|max:50'
        ]);
    }

    /**
     *  Create or update Category
     *  
     *  @param App\Category $category
     *  @param \Illuminate\Http\Request $request
     *  @return void
     */
    private function createOrUpdateCategory(Category $category,Request $request){
        $category->title = $request->title;
        $category->slug  = str_replace(' ','-',$request->title);
        $category->save();
    }
}
