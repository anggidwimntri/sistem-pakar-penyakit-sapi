<?php

namespace App\Http\Controllers\Pakar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gejala;

class GejalaController extends Controller
{
    // Menampilkan daftar semua gejala
    public function index()
    {
        $gejalas = Gejala::all();
        return view('page.gejala.index', compact('gejalas'));
    }

    // Menampilkan form tambah gejala
    public function create()
    {
        return view('page.gejala.create');
    }

    // Menyimpan data gejala baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'kode_gejala' => 'required|unique:gejalas,kode_gejala',
            'nama_gejala' => 'required',
        ]);

        Gejala::create($request->except('_token'));

        return redirect()->route('admin.gejala.index')->with('success', 'Data gejala berhasil ditambahkan.');
    }

    // Menampilkan form edit gejala
    public function edit($id)
    {
        $gejala = Gejala::findOrFail($id);
        return view('page.gejala.edit', compact('gejala'));
    }

    // Memperbarui data gejala
    public function update(Request $request, $id)
    {
        $gejala = Gejala::findOrFail($id);

        $request->validate([
            'kode_gejala' => 'required|unique:gejalas,kode_gejala,' . $id,
            'nama_gejala' => 'required',
        ]);

        $gejala->update($request->except(['_token', '_method']));

        return redirect()->route('admin.gejala.index')->with('success', 'Data gejala berhasil diperbarui.');
    }

    // Menghapus data gejala
    public function destroy($id)
    {
        $gejala = Gejala::findOrFail($id);
        $gejala->delete();

        return redirect()->route('admin.gejala.index')->with('success', 'Data gejala berhasil dihapus.');
    }
}