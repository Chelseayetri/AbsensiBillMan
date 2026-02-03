<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'kata_sandi' => 'required',
        ]);

        // Cari user
        $user = Pengguna::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors([
                'email' => 'Email tidak ditemukan',
            ]);
        }

        // Cek password (bcrypt)
        if (!Hash::check($request->kata_sandi, $user->kata_sandi)) {
            return back()->withErrors([
                'kata_sandi' => 'Kata sandi salah',
            ]);
        }

        // Login manual (TANPA Auth::attempt)
        Auth::guard('web')->login($user);

        $request->session()->regenerate();

        // Redirect berdasarkan peran
        $peran = $user->peran->nama_peran;

        if ($peran === 'Admin') {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('pegawai.dashboard');
    }
}
