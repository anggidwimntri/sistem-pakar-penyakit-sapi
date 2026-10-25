<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Menampilkan halaman form login
    public function showLogin()
    {
        return view('page.login');
    }

  // Memproses data login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            // Ambil data user yang sedang login
            $user = Auth::user();

            // Cek role-nya dan arahkan ke halaman yang sesuai
            if ($user->role === 'admin') {
                return redirect()->intended('/admin/dashboard');
            } elseif ($user->role === 'petugas') {
                return redirect()->intended('/petugas/dashboard'); // Bisa disesuaikan nanti
            } elseif ($user->role === 'pakar') {
                return redirect()->intended('/pakar/dashboard');   // Bisa disesuaikan nanti
            } else {
                return redirect()->intended('/user/dashboard');         // Untuk user / peternak biasa
            }
        }

        // Jika salah email/password, kembalikan dengan pesan error
        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->onlyInput('email');
    }
    // Memproses logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function showRegistrationForm() {
        return view('page.register'); // Buat file view ini
    }

    public function register(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user', // Set role otomatis jadi peternak
        ]);

        return redirect()->route('login')->with('success', 'Akun berhasil dibuat! Silakan login.');

    }
}