<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;

class ContactController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | ContactController
    |--------------------------------------------------------------------------
    |
    | This controller will store contact messages to database.
    |
    */


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateRequest($request);

        $this->createContact($request);

        return redirect()
            ->back()
            ->with('status','Your message has been submitted!');
    }

    /**
     * Validate the Request.
     * 
     * @param \Illuminate\Http\Request $request
     * @return void
     */
    private function validateRequest(Request $request){
        $name = "/^[a-zA-Z0-9 ]+$/";
        $message = "/^[a-zA-Z0-9 -]+$/";

        $this->validate($request,[
            'first_name' => 'nullable|regex:'.$name.'|min:3|max:50',
            'last_name'  => 'nullable|regex:'.$name.'|min:3|max:50',
            'email'      => 'required|email|min:7|max:150',
            'message'    => 'required|'.$message.'|min:20',
        ]);
    }

    /**
     * Create contact resource in the database.
     * 
     * @param \Illuminate\Http\Request $request
     * @return void
     */
    private function createContact(Request $request){
        Contact::create([
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'email'      => $request->email,
            'message'    => $request->message
        ]);
    }
}
