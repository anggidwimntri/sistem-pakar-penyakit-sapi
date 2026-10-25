<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Menampilkan daftar seluruh pengguna
    public function index()
    {
        $users = User::latest()->paginate(10);
        return view('page.kelola-user.index', compact('users'));
    }

    // Menampilkan form tambah pengguna baru
    public function create()
    {
        return view('page.kelola-user.create');
    }

    // Menyimpan data pengguna baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'role'     => 'required|in:admin,pakar,petugas,user',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Pengguna baru berhasil ditambahkan.');
    }

    // Menampilkan form edit pengguna
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('page.kelola-user.edit', compact('user'));
    }

    // Memperbarui data pengguna
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'role'  => 'required|in:admin,pakar,petugas,user',
        ]);

        $data = [
            'name'  => $request->name,
            'email' => $request->email,
            'role'  => $request->role,
        ];

        // Jika kolom password diisi saat edit, ubah passwordnya
        if ($request->filled('password')) {
            $request->validate(['password' => 'string|min:6']);
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.users.index')->with('success', 'Data pengguna berhasil diperbarui.');
    }

    // Menghapus data pengguna
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Mencegah admin menghapus akunnya sendiri
        if (auth()->user()->id == $user->id) {
            return redirect()->route('admin.users.index')->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil dihapus.');
    }
}