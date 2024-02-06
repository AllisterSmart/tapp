<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class SettingController extends Controller

{    
    // ***** New Admin And Change Profile Controller *****
    public function userlist()
    {
      $adminsetting = User::all();
      $usersetting = User::all();
      return view('admin.setting.adminaccount.userlist',compact('adminsetting','usersetting'));  
    }

    public function newadmin()
    {
      $adminsetting = User::all();
      return view('admin.setting.adminaccount.createadmin',compact('adminsetting'));  
    }
    
 public function storeadmin(Request $request)
{
    // Validate the incoming request data
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6',
    ]);

    // Hash the password
    $hashedPassword = Hash::make($request->password);

    // Insert the user into the 'users' table
    DB::insert('INSERT INTO users (name, email, password) VALUES (?, ?, ?)', [$request->name, $request->email, $hashedPassword]);

    return redirect()->route('home');
}


    public function editadmin(Request $request)
    {
        
        $adminsetting = DB::select('select * from users WHERE id = ?', [$request->id]);
        return view('admin.setting.adminaccount.editadmin', compact('adminsetting'));
    }


   public function updateadmin(Request $request){
    // Fetch the admin record to update
    $adminsetting = DB::table('users')->where('id', $request->id)->first();
    
    if ($adminsetting) {
        // Update the admin's information
        DB::table('users')->where('id',  $request->id)->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')), // Hash the password for security
        ]);
        
        return redirect()->route('home')->with('status', 'Admin Updated Successfully');
    } else {
        return redirect()->route('home')->with('error', 'Admin not found');
    }
   }
}
