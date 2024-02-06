<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UpcomingTournamentsController extends Controller
{
    public function upcomingtournament()
    {
        return view('admin.upcomingtournament.index');
    }
   
}