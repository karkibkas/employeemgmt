<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Address;

class AddressesController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | AddressesController
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for displaying a list of addresses,
    | creating, updating and deleting addresses.
    |
    */


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
     * Display a listing of all Addresses.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $addresses = Address::orderBy('created_at')->paginate(10);
        return view('admin.addresses.index',[
            'addresses' => $addresses
        ]);
    }

    /**
     * Show the form for creating a new Address.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.addresses.create');
    }

    /**
     * Store a newly created Address in database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateRequest($request);
        $address = new Address();
        $this->createOrUpdateAddress($request,$address);

        return redirect()
            ->route('admin.addresses.index')
            ->with('status','New Address has been created!');
    }

    /**
     * Display the specified Address.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->showAddress($id,'show');
    }

    /**
     * Show the form for editing the specified Address.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return $this->showAddress($id,'edit');
    }

    /**
     * Update the specified Address from database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validateRequest($request);
        $address = Address::findOrFail($id);
        $this->createOrUpdateAddress($request,$address);

        return redirect()
            ->route('admin.addresses.index')
            ->with('status','Selected Address has been updated!');
    }

    /**
     * Remove the specified Address from database.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Address::destroy($id);
        return redirect()
            ->route('admin.addresses.index')
            ->with('status','Selected address has been deleted!');
    }

    /**
     * Validate Request
     * 
     * @param \Illuminate\Http\Request $request
     * @return void
     */
    private function validateRequest(Request $request){
        $this->validate($request,[
            'address_1'   => 'required|string|min:5',
            'address_2'   => 'required|string|min:5',
            'city'        => 'required|string|min:3',
            'postal_code' => 'required|string|min:3'
        ]);
    }

    /**
     * Create a new or update an existing 
     * address.
     * 
     * @param \Illuminate\Http\Request $request
     * @param App\Address $address
     * @return void
     */
    private function createOrUpdateAddress(Request $request,Address $address){
        $address->address_1 = $request->address_1;
        $address->address_2 = $request->address_2;
        $address->city = $request->city;
        $address->postal_code = $request->postal_code;
        $address->save();
    }

    /**
     * Show a view with address
     *  
     * @param int $id
     * @param string $view
     * @return \Illuminate\Http\Response
     */
    private function showAddress($id,$view){
        $address = Address::findOrFail($id);
        return view('admin.addresses.'.$view,[
            'address' => $address
        ]);
    }
}
