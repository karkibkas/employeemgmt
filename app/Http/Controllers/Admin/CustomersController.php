<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Hash;

class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = User::orderBy('created_at')->paginate(10);
        return view('admin.customers.index',[
            'customers' => $customers
        ]);
    }

    /**
     * Show a form for creating a new Customer.
     * 
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('admin.customers.create');
    }

    /**
     * Store a new Customer to the database.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $this->validateRequest($request,null);
        $customer = new User();
        $this->createOrUpdateCustomer($request,$customer);
        return redirect()
            ->route('admin.customers.index')
            ->with('status','New customer has been created!');
    }

    /**
     * Show the form for editing the specified Customer.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customer = User::findOrFail($id);
        return view('admin.customers.edit',[
            'customer' => $customer
        ]);
    }

    /**
     * Update the specified Customer in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validateRequest($request,$id);
        $customer = User::findOrFail($id);
        $this->createOrUpdateCustomer($request,$customer);
        return redirect()
            ->route('admin.customers.index')
            ->with('status','Selected Customer has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Validate the request.
     * 
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return void
     */
    private function validateRequest(Request $request,$id){
        $this->validate($request,[
            'name' => 'required|string|min:3|max:50',
            'email' => 'required|email|min:7|max:150',
            'password' => ((!$id) ? 'required' : 'nullable' ).'|string'
        ]);
    }

    /**
     * Create a new Customer or update an existing customer.
     * 
     * @param \Illuminate\Http\Request $request
     * @param App\User $customer
     * @return void
     */
    private function createOrUpdateCustomer(Request $request,User $customer){
        $customer->name = $request->name;
        $customer->email = $request->email;
        if($request->password){
            $customer->password = Hash::make($request->password);
        }
        $customer->save();
    }
}
