<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        $this->middleware('auth');
    }
    
    /**
     * Show Admin Profile
     *  
     * @return \Illuminate\Http\Response
     */
    public function show(){
        return view('profile.index');
    }

    /**
     * update Profile
     *  
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request){
        $this->validateRequest($request);
        
        $this->updateUser($request);

        return redirect()
            ->back()
            ->with('status','User profile has been updated!');
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
     *  Update the Customer (User)
     * 
     *  @param \Illuminate\Http\Request $request
     *  @return void
     */
    private function updateUser(Request $request){
        // get the current admin with Auth facade
        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        /**
         *  if we are updating the password.
         *  if left empty then don't update
         *  password. 
         */
        if($request->password){
            $user->password = Hash::make($request->password);
        }
        
        $user->save();
    }
}
