<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;
use App\Models\User;



class AuthController extends Controller
{
    public function login(Request $request)
{
    // Validate the request...

    // Attempt to verify the credentials and create a token for the user
    if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
        // Update the user's api_token
        $user = Auth::user();
        $token = $user->createToken('api_token')->plainTextToken;

        return response()->json(['user' => $user, 'api_token' => $token], 200);
    }

    // Authentication failed...
    return response()->json(['error' => 'Invalid credentials'], 401);
}

public function register(Request $request)
{
    // Validate the request data
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8',
    ]);

    // Create a new user
    $user = new User;
    $user->name = $request->name;
    $user->email = $request->email;
    $user->password = Hash::make($request->password);
    $user->save();

    // Generate an API token for the user
    $token = $user->createToken('api_token')->plainTextToken;

    // Return the user and token
    return response()->json(['user' => $user, 'token' => $token], 201);
}

}
