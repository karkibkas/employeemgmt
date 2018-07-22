<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
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
     *  Show the Dashboard View
     * 
     *  @return \Illuminate\Http\Response
     */
    public function index(){
        return view('admin.dashboard.index');
    }
}
