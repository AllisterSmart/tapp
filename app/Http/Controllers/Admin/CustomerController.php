<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
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
    public function customer()
    {
        $customer = Customer::all();
        $adminsetting = User::all();
        return view('admin.customer.index',compact('customer','adminsetting'));

    }

    public function customercreate()
    {
        $adminsetting = User::all();
        return view('admin.customer.create',compact('adminsetting'));

    }

    public function customerstore(Request $request)
{
    $customer = new Customer;
    $customer->customer_name = $request->input('customer_name');
    $customer->customer_email = $request->input('customer_email');
    $customer->customer_address = $request->input('customer_address');
    $customer->customer_mobile = $request->input('customer_mobile');
    $customer->project_name = $request->input('project_name');
    $customer->project_price = $request->input('project_price');
    $customer->date = $request->input('date');
    $customer->date2 = $request->input('date2');
    $customer->date3 = $request->input('date3');
    $customer->date4 = $request->input('date4');
    $customer->p_amount = $request->input('p_amount');
    $customer->p2_amount = $request->input('p2_amount');
    $customer->p3_amount = $request->input('p3_amount');
    $customer->p4_amount = $request->input('p4_amount');
    $customer->d_amount = $request->input('d_amount');
    $customer->d2_amount = $request->input('d2_amount');
    $customer->d3_amount = $request->input('d3_amount');
    $customer->d4_amount = $request->input('d4_amount');
    $customer->discreption = $request->input('discreption');
    $customer->save();
    return redirect()->back()->with('status', 'Customer Image Added Successfully');
}
    

     public function customeredit($id)
    {
        $customer = Customer::find($id);
        $adminsetting = User::all();
        return view('admin.customer.edit',compact('customer','adminsetting'));

    }

     public function customerupdate(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);
        $customer->customer_name = $request->input('customer_name');
    $customer->customer_email = $request->input('customer_email');
    $customer->customer_address = $request->input('customer_address');
    $customer->customer_mobile = $request->input('customer_mobile');
    $customer->project_name = $request->input('project_name');
    $customer->project_price = $request->input('project_price');
    $customer->date = $request->input('date');
    $customer->date2 = $request->input('date2');
    $customer->date3 = $request->input('date3');
    $customer->date4 = $request->input('date4');
    $customer->p_amount = $request->input('p_amount');
    $customer->p2_amount = $request->input('p2_amount');
    $customer->p3_amount = $request->input('p3_amount');
    $customer->p4_amount = $request->input('p4_amount');
    $customer->d_amount = $request->input('d_amount');
    $customer->d2_amount = $request->input('d2_amount');
    $customer->d3_amount = $request->input('d3_amount');
    $customer->d4_amount = $request->input('d4_amount');
    $customer->discreption = $request->input('discreption');
        $customer->save();
    
     return redirect()->route('customer')->with('status','Customer Update Successfully');
 }

     public function customerdelete($id)
    {
        $customer = Customer::find($id);
        $customer->delete();
        return redirect()->back()->with('status','Delete Successfully');


    }
}

