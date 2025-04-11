<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    //
    public function register(Request $request)
    {
        if (User::where('username', $request->username)->exists()) {
            return redirect()->back()->with('error', 'Username sudah digunakan');
        }
    
        if (User::where('email', $request->email)->exists()) {
            return redirect()->back()->with('error', 'Email sudah digunakan');
        }

        if ($request->password !== $request->password_confirmation) {
            return redirect()->back()->with('error', 'Konfirmasi password tidak cocok');
        }        

        $request->validate([
            'username' => 'required|string|max:50',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed'
        ]);

        User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('home')->with('success', 'Account created successfully! Please Login');
    }
 
}
