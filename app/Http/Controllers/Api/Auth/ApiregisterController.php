<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ApiregisterController extends Controller
{
    public function register(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string',
                'email' => 'required|email|unique:users',
                'mobile' => 'required|numeric|unique:users',
                'address' => 'required|string',
                'picture' => 'required|string',
                'password' => 'required|string|min:6',
                'role' => 'required|string', // Adjust validation rules based on your needs
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'address' => $request->address,
                'picture' => $request->picture,
                'password' => Hash::make($request->password),
                'role' => $request->role,
            ]);

            return response()->json(['user' => $user], 201); // 201 Created status code
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()], 422); // 422 Unprocessable Entity status code
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to register user'], 500); // 500 Internal Server Error status code
        }
    }
}
