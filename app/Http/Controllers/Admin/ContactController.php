<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

class ContactController extends Controller
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
    public function contact()
    {
        return view('admin.contact.index');

    }

    public function contactcreate()
    {
        return view('admin.contact.create');

    }

     public function contactedit()
    {
        return view('admin.contact.create');

    }

     public function contactupdate()
    {
        return view('admin.contact.create');

    }

     public function contactdelete()
    {
        return view('admin.contact.create');

    }


}
