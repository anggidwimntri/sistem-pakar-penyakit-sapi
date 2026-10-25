<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    // Menampilkan halaman profil
    public function edit()
    {
        $user = Auth::user();
        return view('page.profil-edit', compact('user'));
    }

    // Memperbarui data profil (Nama & Email)
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        ]);

        $user->update([
            'name'  => $request->name,
            'email' => $request->email,
        ]);

        return back()->with('success', 'Profil berhasil diperbarui!');
    }

    // Memperbarui Password
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password'     => 'required',
            'password'             => 'required|min:6|confirmed',
        ]);

        $user = Auth::user();

        // Cek apakah password lama sesuai
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password lama tidak sesuai!']);
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('success_password', 'Password berhasil diubah!');
    }
}
