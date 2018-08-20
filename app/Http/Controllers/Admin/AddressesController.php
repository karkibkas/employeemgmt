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
    public function index(Request $request)
    {
        $title = null;
        if($request->search){
            $search = $request->search;
            $option = ($request->option) ? : 'address_1' ;
            $addresses = Address::where($option,'LIKE',"%{$search}%")->paginate(10);
            $title = "Search results by {$option} for \"{$search}\"";
        }else{
            $addresses = Address::orderBy('created_at')->paginate(10);
        }
        return view('admin.addresses.index',[
            'addresses' => $addresses,
            'title'     => $title
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
        $address = Address::findOrFail($id);
        
        if($address->orders->count()){
            return redirect()
                ->back()
                ->with('status','Cannot delete an address that belongs to an order!');
        }
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
        //allow numbers, letters underscores, spaces, and dashes.
        $address = "/^[a-zA-Z0-9_ -]+$/";

        //allow numbers, letters and spaces
        $city = "/^[a-zA-Z0-9 ]+$/";
        
        //allow numbers, letters.
        $postalcode = "/^[a-zA-Z0-9]+$/";

        $this->validate($request,[
            'address_1'   => "required|regex:{$address}|min:5|max:500",
            'address_2'   => "required|regex:{$address}|min:5|max:500",
            'city'        => "required|regex:{$city}|min:3|max:50",
            'postal_code' => "required|regex:{$postalcode}|min:3|max:50"
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
