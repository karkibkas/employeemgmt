<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Hash;

class ProfileController extends Controller
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
     * Show Admin Profile
     *  
     * @return \Illuminate\Http\Response
     */
    public function show(){
        return view('admin.profile.index');
    }

    /**
     * update Profile
     *  
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request){
        $this->validateRequest($request);
        
        $this->updateAdmin($request);

        return redirect()
            ->back()
            ->with('status','Admin profile has been updated!');
    }

    /**
     * Validate Request
     *  
     * @param \Illuminate\Http\Request $request
     * @return void
     */
    private function validateRequest(Request $request){
        $this->validate($request,[
            'name' => 'required|string|min:3|max:50',
            'email' => 'required|email|min:7|max:150',
            'password' => 'nullable|string|min:7|max:100'
        ]);
    }

    /**
     *  Update the Admin
     * 
     *  @param \Illuminate\Http\Request $request
     *  @return void
     */
    private function updateAdmin(Request $request){
        // get the current admin with Auth facade
        $admin = Auth::guard('admin')->user();
        $admin->name = $request->name;
        $admin->email = $request->email;
        /**
         *  if we are updating the password.
         *  if left empty then don't update
         *  password. 
         */
        if($request->password){
            $admin->password = Hash::make($request->password);
        }
        
        $admin->save();
    }
}
