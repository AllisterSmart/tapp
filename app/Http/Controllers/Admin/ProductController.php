<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

class ProductController extends Controller
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
    public function product()
    {
        return view('admin.product.index');

    }

    public function productcreate()
    {
        return view('admin.product.create');

    }

     public function productedit()
    {
        return view('admin.product.create');

    }

     public function productupdate()
    {
        return view('admin.product.create');

    }

     public function productdelete()
    {
        return view('admin.product.create');

    }


}
