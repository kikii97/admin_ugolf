<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    // Display the login form
    public function showLoginForm()
    {
        return view('login'); // The view file for your HTML code
    }

    // Handle the login request
    public function loginD(Request $request)
    {
        // Validate input
        $response = Http::post(env('API_URL').'/login', [ 
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

    public function login(Request $request)
    {
        $response = Http::post(env('API_URL').'/login', [
            'email' => $request->email,
            'password' => $request->password,
        ]);

        if ($response->successful()) {
            $data = $response->json();
            session(['jwt_token' => $data['token']]);
            session(['user_name' => $data['user']['name']]);

            return redirect()->route('dashboard')->with('success', 'Login berhasil');
        } else {
            return back()->withErrors(['error' => 'Login gagal, periksa kredensial Anda.']);
        }
    }

    // Logout method
    public function logout()
    {
        //Auth::logout();
        session()->forget(['jwt_token', 'user_name', 'roles', 'permissions']);
        return redirect('/login')->with('success', 'Logged out successfully');
    }
}

