<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Games;
use App\Models\Category;
use App\Models\Players;

class UserlistController extends Controller
{
    public function userlist()
    {
        $userList1 = User::all();
    $userList2 = Games::all();
    $userList3 = Category::all();
    $userList4 = Players::all();

    // Concatenate the collections and sort them by user_id
    $userlist = $userList1->concat($userList2)->concat($userList3)->concat($userList4)->sortBy('user_id');

        return view('admin.users.index', compact('userlist'));
    }
    

   
}