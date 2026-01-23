<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Form login
    public function formLogin()
    {
        return view('auth.login');
    }

    // Proses login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'kata_sandi' => 'required'
        ]);

        $credentials = [
            'email' => $request->email,
            'password' => $request->kata_sandi
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $peran = auth()->user()->peran->nama_peran;

            if ($peran == 'Admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($peran == 'Petugas') {
                return redirect()->route('petugas.dashboard');
            }
        }

        return back()->withErrors([
            'email' => 'Email atau kata sandi salah',
        ])->onlyInput('email');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
