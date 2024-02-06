<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;

class ApiLoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $input = $request->all();
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt(['email' => $input['email'], 'password' => $input['password']])) {
            if (Auth::user()->role == 1) {
                return response()->json(['redirect' => route('admin.dashboard')]);
            } elseif (Auth::user()->role == 2) {
                return response()->json(['redirect' => route('user.dashboard')]);
            }
        } else {
            return response()->json(['error' => 'Email and password are wrong'], 401);
        }
    }
}
