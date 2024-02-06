<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Models\Location;

class UserController extends Controller
{
   function index(Request $request){

    $events = Location::all();
    $randomNumber = random_int(100000, 999999);
    return view ('web.web' ,compact('events','randomNumber'));
   }

   function profile(){
       return view('dashboards.users.profile');
   }
   function settings(){
       return view('dashboards.users.settings');
   }
}
