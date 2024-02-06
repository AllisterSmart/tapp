<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OngoingTournamentsController extends Controller
{
    public function ongoingtournament()
    {
        return view('admin.ongoingtournament.index');
    }

   
}