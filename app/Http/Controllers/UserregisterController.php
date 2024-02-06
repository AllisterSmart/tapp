<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Userregister;

class UserregisterController extends Controller
{
    public function showRegistrationForm()
    {
        // Add logic if needed for displaying the registration form on the web
        return view('web.web');
    }

    public function register(Request $request)
    {
        // Validate the incoming data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'user_id' => 'required|string|max:255',
            'state' => 'required|string',
            'mobile_email' => 'required|string|max:255',
            'dob' => 'required|string|max:255',
            'referalcode' => 'nullable|string|max:255',
        ]);

        // Create a new user
        $user = Userregister::create($validatedData);

        // Redirect or respond based on the context
        return redirect()->route('home')->with('success', 'User registered successfully');
    }

    public function apiRegister(Request $request)
    {
        // Validate the incoming data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'user_id' => 'required|string|max:255',
            'state' => 'required|string',
            'mobile_email' => 'required|string|max:255',
            'dob' => 'required|string|max:255',
            'referalcode' => 'nullable|string|max:255',
        ]);

        // Create a new user
        $user = Userregister::create($validatedData);

        // Return a JSON response
        return response()->json(['message' => 'User registered successfully'], 201);
    }
}
