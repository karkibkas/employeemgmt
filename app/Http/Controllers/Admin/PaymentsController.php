<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Payment;

class PaymentsController extends Controller
{
    /**
     * Display a listing of the Payments.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payments = Payment::orderBy('created_at')->paginate(10);
        return view('admin.payments.index',[
            'payments' => $payments
        ]);
    }

    /**
     * Remove the specified payment from database.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Payment::destroy($id);
        return redirect()
            ->back()
            ->with('status','Selected payment has been deleted!');
    }
}
