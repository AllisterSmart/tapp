<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TournamentsResultController extends Controller
{
    public function tournamentresult()
    {
        return view('admin.tournamentresult.index');
    }

  
}