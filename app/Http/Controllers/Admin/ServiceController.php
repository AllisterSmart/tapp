<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

class ServiceController extends Controller
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
    public function service()
    {
        return view('admin.service.index');

    }

    public function servicecreate()
    {
        return view('admin.service.create');

    }

     public function serviceedit()
    {
        return view('admin.service.create');

    }

     public function serviceupdate()
    {
        return view('admin.service.create');

    }

     public function servicedelete()
    {
        return view('admin.service.create');

    }


}
