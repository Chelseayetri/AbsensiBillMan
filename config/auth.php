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
            'email'       => 'required|email',
            'kata_sandi'  => 'required',
        ]);

        // Cari user berdasarkan email
        $user = Pengguna::where('email', $request->email)->first();

        if (!$user) {
            return back()
                ->withErrors(['email' => 'Email tidak ditemukan'])
                ->withInput();
        }

        // Cek password (bcrypt)
        if (!Hash::check($request->kata_sandi, $user->kata_sandi)) {
            return back()
                ->withErrors(['kata_sandi' => 'Kata sandi salah'])
                ->withInput();
        }

        // Login manual
        Auth::login($user);
        $request->session()->regenerate();

        // Pastikan relasi peran ada
        if (!$user->peran) {
            Auth::logout();
            return redirect()->route('login')
                ->with('error', 'Akun belum memiliki peran.');
        }

        $peran = strtolower($user->peran->nama_peran);

        // Redirect sesuai peran
        switch ($peran) {
            case 'admin':
                return redirect()->route('admin.dashboard');

            case 'petugas':
                return redirect()->route('petugas.dashboard');

            default:
                Auth::logout();
                return redirect()->route('login')
                    ->with('error', 'Peran pengguna tidak dikenali.');
        }
    }
}
