<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class loginController extends Controller
{
    public function loginForm() {
        return view('auth.login');
    }

    public function login(Request $request) {
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        try {
            if (Auth::attempt($credentials)) {
                $user = Auth::user();

                if ($user->role_id === 1) {
                    return redirect()->route('admin.index');
                } else {
                    return redirect()->route('home');
                }
            }

            return back()->withErrors(['email' => 'Email atau password salah']);
        } catch (\Exception $e) {
            return back()->withErrors([
                'error' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ])->withInput();
        }
    }
}
