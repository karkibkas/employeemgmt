<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     *  Show the Dashboard View
     * 
     *  @return \Illuminate\Http\Response
     */
    public function index(){
        return view('admin.dashboard.index');
    }
}
