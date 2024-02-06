<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WithdrawRequestController extends Controller
{
    public function withdrawrequest()
    {
        return view('admin.withdrawrequest.index');
    }
   
}