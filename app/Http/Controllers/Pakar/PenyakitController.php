<?php

namespace App\Http\Controllers\Pakar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Penyakit;

class PenyakitController extends Controller
{
    // Menampilkan daftar semua penyakit
    public function index()
    {
        $penyakits = Penyakit::all();
        return view('page.penyakit.index', compact('penyakits'));
    }

    // Menampilkan form tambah penyakit
    public function create()
    {
        return view('page.penyakit.create');
    }

    // Menyimpan data penyakit baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'kode_penyakit' => 'required|unique:penyakits,kode_penyakit',
            'nama_penyakit' => 'required',
            'deskripsi'     => 'nullable',
            'solusi'        => 'nullable',
        ]);

        Penyakit::create($request->all());

        return redirect()->route('pakar.penyakit.index')->with('success', 'Data penyakit berhasil ditambahkan.');
    }

    // Menampilkan form edit penyakit
    public function edit($id)
    {
        $penyakit = Penyakit::findOrFail($id);
        return view('page.penyakit.edit', compact('penyakit'));
    }

    // Memperbarui data penyakit di database
    public function update(Request $request, $id)
    {
        $penyakit = Penyakit::findOrFail($id);

        $request->validate([
            'kode_penyakit' => 'required|unique:penyakits,kode_penyakit,' . $id,
            'nama_penyakit' => 'required',
            'deskripsi'     => 'nullable',
            'solusi'        => 'nullable',
        ]);

        $penyakit->update($request->all());

        return redirect()->route('pakar.penyakit.index')->with('success', 'Data penyakit berhasil diperbarui.');
    }

    // Menghapus data penyakit
    public function destroy($id)
    {
        $penyakit = Penyakit::findOrFail($id);
        $penyakit->delete();

        return redirect()->route('pakar.penyakit.index')->with('success', 'Data penyakit berhasil dihapus.');
    }
}