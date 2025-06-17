<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login()
    {
        return view('Landing_Page.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'no_peserta' => ['required', 'string'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            // Arahkan berdasarkan role
            if ($user->role === 'admin') {
                return redirect()->route('dashboard');
            } elseif ($user->role === 'siswa') {
                return redirect()->route('siswa.profile');
            }

            // Default redirect jika role tidak diketahui
            return redirect('/');
        }

        return back()->with('loginError', '❌ Login gagal. Silakan periksa kembali no peserta dan password Anda.');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
