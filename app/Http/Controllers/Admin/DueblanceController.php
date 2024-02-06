<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\User;
use DB;
use Illuminate\Http\Request;

class DueblanceController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
   public function dueblance(Request $request)
{
    $customerId = $request->id; // Assuming 'id' is the name of the parameter holding the customer ID
    
    $paidPrice = Customer::where('id', $customerId)
        ->select(DB::raw('SUM(p_amount + p2_amount + p3_amount + p4_amount) as total_amount'))
        ->first();

    $totalAmount = $paidPrice ? $paidPrice->total_amount : 0;

    $paidamount = Customer::all();

    $adminsetting = User::all();

    return view('admin.dueblance.index', compact('paidamount', 'totalAmount','adminsetting'));
}

}
