<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Contact;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = Contact::orderBy('created_at','desc')->paginate(10);
        return view('admin.contacts.index',[
            'contacts' => $contacts
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->showContact($id,'show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return $this->showContact($id,'edit');
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
        $this->validateContact($request);
        $contact = Contact::findOrFail($id);
        
        if($request->first_name){
            $contact->first_name = $request->first_name;
        }

        if($request->last_name){
            $contact->last_name = $request->last_name;
        }

        $contact->email = $request->email;
        $contact->message = $request->message;
        $contact->save();
        
        return redirect()
            ->route('admin.contacts.index')
            ->with('status','Selected contact message has been updated!');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        
        $contact->delete();
        
        return redirect()
            ->route('admin.contacts.index')
            ->with('status','Selected contact message has been deleted!');
        
    }

    /**
     * Show details of a specific contact message.
     * 
     * @param int $id
     * @param string $view
     * @return \Illuminate\Http\Response
     */
    private function showContact($id,$view){
        $contact = Contact::findOrFail($id);
        return view('admin.contacts.'.$view,[
            'contact' => $contact
        ]);
    }

    /**
     * Validate the request
     * 
     * @param \Illuminate\Http\Request $request
     * @return void
     */
    private function validateContact(Request $request){
        //allow numbers, letters and spaces
        $message = "/^[a-zA-Z0-9 ]+$/";

        //allow letters and spaces
        $name = "/^[a-zA-Z ]+$/";

        $this->validate($request,[
            'first_name' => 'nullable|regex:'.$name.'|min:3|max:50',
            'last_name'  => 'nullable|regex:'.$name.'|min:3|max:50',
            'email'      => 'required|email|min:5|max:150',
            'message'    => 'required|regex:'.$message.'|min:20|max:500',
        ],[
            'first_name.regex' => 'Only letters and spaces are allowed',
            'last_name.regex' => 'Only letters and spaces are allowed',
            'message.regex' => 'Only letters, spaces, and numbers are allowed'
        ]);
    }
}
