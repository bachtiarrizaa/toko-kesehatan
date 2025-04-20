<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class registerController extends Controller
{
    public function registerForm() {
        return view('auth.register');
    }

    public function register(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:male,female',
            'address' => 'required|string|max:255',
            'telp' => 'required|string|max:15',
            'paypalId' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);
    
        try {
            User::create([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'date_of_birth' => $request->date_of_birth,
                'gender' => $request->gender,
                'address' => $request->address,
                'telp' => $request->telp,
                'paypalId' => $request->paypalId,
                'city' => $request->city,
                'role_id' => 2, // Ini role customer ya btw
                'password' => Hash::make($request->password),
            ]);
    
            return redirect()->route('login')->with('success', 'Registrasi Berhasil! Silakan login.');
        } catch (\Exception $e) {
            return back()->withErrors([
                'error' => 'Terjadi kesalahan; ' . $e->getMessage(),
            ])->withInput();
        }
    }
    
}
