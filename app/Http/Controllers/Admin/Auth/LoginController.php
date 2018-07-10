<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Admin Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating admins for the application and
    | redirecting them to Admin dashboard. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // for guests that are not logged in as admin.
        // Except for logout
        $this->middleware('guest:admin')->except('logout');
    }

    /**
     *  Show the Login Form
     *  
     *  @return \Illuminate\Http\Response
     */
    public function showLoginForm(){
        return view('admin.auth.login');
    }

    /**
     *  Login the User
     *  
     *  @param \Illuminate\Http\Request $request
     *  @return \Illuminate\Http\Response
     */
    public function login(Request $request){
        
        $this->validateLogin($request);
        
        /**
         *  If login attempt to the admin guard is failed
         *  then redirect the user back with input, e.g email.
         */
        if(!Auth::guard('admin')
        ->attempt(['email' => $request->input('email'), 'password' => $request->input('password')]
        ,$request->remember)){
            return redirect()
                ->route('admin.login')
                ->withInput()
                ->with('status','Login failed!');
        }

        /**
         *  Admin Login was successful
         */
        return redirect()
            ->route('admin.dashboard')
            ->with('status','You are logged in!');
    }


    /**
     *  Logout the Admin
     * 
     *  @return void
     */
    public function logout(){
        /**
         *  Logging out the admin having admin guard
         */
        Auth::guard('admin')->logout();
        return redirect()->route('index');
    }

    /**
     *  Validate Login Request
     * 
     *  @param \Illuminate\Http\Request $request
     *  @return void
     */
    public function validateLogin(Request $request){
        $this->validate($request,[
            'email' => 'required|email|min:7|max:150',
            'password' => 'required|string'
        ]);
    }
}
