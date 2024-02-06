<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MainDataController extends Controller
{
    public function maindata()
    {
        return view('admin.maindata.index');
    }

    public function create()
    {
        // Add your logic for creating data here
    }

    public function store(Request $request)
    {
        // Add your logic for storing data here
    }

    public function editdata($id)
    {
        // Add your logic for editing data here
    }

    public function updatedata(Request $request, $id)
    {
        // Add your logic for updating data here
    }

    public function deletedata($id)
    {
        // Add your logic for deleting data here
    }
}
