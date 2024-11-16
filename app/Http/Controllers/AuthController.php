<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    // Display the login form
    public function showLoginForm()
    {
        return view('login'); // The view file for your HTML code
    }

    // Handle the login request
    public function login(Request $request)
    {
        // Validate input
        $response = Http::post('192.168.0.117/api/login', [
            'email' => $request->email,
            'password' => $request->password,
        ]);

        // Check credentials and log in
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication successful, redirect to dashboard
            return redirect()->intended('/dashboard')->with('success', 'Login successful');
        }

        // Authentication failed, redirect back with error
        return back()->withErrors(['loginError' => 'Invalid credentials']);
    }

    // Logout method
    public function logout()
    {
        Auth::logout();
        return redirect('/login')->with('success', 'Logged out successfully');
    }
}

