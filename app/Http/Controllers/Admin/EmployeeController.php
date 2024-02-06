<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

class EmployeeController extends Controller
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
    public function employee()
    {
        return view('admin.employee.index');

    }

    public function employeecreate()
    {
        return view('admin.employee.create');

    }

     public function employeeedit()
    {
        return view('admin.employee.create');

    }

     public function employeeupdate()
    {
        return view('admin.employee.create');

    }

     public function employeedelete()
    {
        return view('admin.employee.create');

    }


}
