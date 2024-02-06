<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OflinePaymentController extends Controller
{
    public function oflinepayment()
    {
        return view('admin.oflinepayment.index');
    }
   
}