<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function redirectTo()
    {
        if (auth()->user()->role == 1) {
            return route('admin.dashboard');
        } elseif (auth()->user()->role == 2) {
            return route('user.dashboard');
        }
    }

    public function login(Request $request)
    {
        $input = $request->all();

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (auth()->attempt(['email' => $input['email'], 'password' => $input['password']])) {
            $user = auth()->user();

            // Check user status
            if ($user->status == 'pending') {
                // User status is pending, redirect to OTP verification
                auth()->logout();
                return redirect()->route('verify.otp', ['user' => $user->id])->with('error', 'Please wait for activation. Check Your Mail and Submit Your OTP');
            } elseif ($user->status == 'active') {
                // User status is active, allow login
                return redirect()->intended($this->redirectTo());
            }
        } else {
            return redirect()->route('login')->with('error', 'Email and password are incorrect.');
        }
    }
}
