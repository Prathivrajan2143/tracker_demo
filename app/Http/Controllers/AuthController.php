<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function authenticate(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to log the user in
        if (Auth::attempt([
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ])) {
        
        // Authentication was successful
            $user = Auth::user();
            // return response()->json([
            //     'message' => 'Login successful',
            //     'user' => $user
            // ], 200);

            return redirect()->route('dashboard');
            // return view('dashboard', compact('users', 'clients', 'roles'));
        }

        // Authentication failed
            return response()->json([
                'message' => 'Invalid credentials'
            ], 401);
    }
}
