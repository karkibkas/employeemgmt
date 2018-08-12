<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Address;
use App\Order;

class OrdersController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | OrdersController
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for displaying a list of customer orders,
    | displaying details of a single order, updating and deleting customer orders.
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
     * Display a listing of the Customer Orders.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::orderBy('created_at')->paginate(10);
        return view('admin.orders.index',[
            'orders' => $orders
        ]);
    }

    /**
     * Display the specified Order.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::findOrFail($id);
        $products  = $order->products()->paginate(10);
        return view('admin.orders.show',[
            'order' => $order,
            'products' => $products,
        ]);
    }

    /**
     * Show the form for editing the specified Order.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = Order::findOrFail($id);
        $addresses = Address::all();
        return view('admin.orders.edit',[
            'order'     => $order,
            'addresses' => $addresses
        ]);
    }

    /**
     * Update the specified Order in database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validateRequest($request);

        $order = Order::findOrFail($id);
        
        $this->updateOrder($request,$order);

        return redirect()
            ->route('admin.orders.index')
            ->with('status','Selected order has been updated!');
    }

    /**
     * Remove the specified Order from database.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        if($order->products && $order->address && $order->payment){
            return $this->redirect('Cannot deleted an Order thats related to payments!');
        }
        
        $order->delete();
        return $this->redirect('Selected Order has been deleted!');
        
    }


    /**
     * Validate Request
     *  
     * @param \Illuminate\Http\Request $request
     * @return void
     */
    private function validateRequest(Request $request){
        $this->validate($request,[
            'total' => 'required|integer|min:1',
            'paid'  => 'required|integer',
            'address' => 'required|integer'
        ]);
    }

    /**
     * Update Order
     * 
     * @param \Illuminate\Http\Request $request
     * @return void
     */
    private function updateOrder(Request $request,Order $order){
        $order->paid = $request->paid;
        $order->address_id = $request->address;
        $order->total = $request->total;
        $order->save();
    }
    
    /**
     *  redirect with message
     */
    private function redirect($msg){
        return redirect()
            ->back()
            ->with('status',$msg);
    }
}
