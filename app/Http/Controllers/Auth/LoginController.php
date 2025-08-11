<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Form login
     */
    public function showLogin()
    {
        return view('auth.login'); // view login umum, tidak khusus admin
    }

    /**
     * Proses login
     */
    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Proses autentikasi
        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();

            // Ambil role user
            $role = Auth::user()->role;

            // Redirect sesuai role
            return match ($role) {
                'admin' => redirect()->route('admin.dashboard'),
                'upja'  => redirect()->route('upja.dashboard'),
                'farmer'  => redirect()->route('farmer.dashboard'),
                default => redirect('/'), // fallback
            };
        }

        // Jika gagal login
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    /**
     * Logout user
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login'); // arahkan ke form login
    }
}
