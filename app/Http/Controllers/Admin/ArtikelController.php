<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use App\Models\Penyakit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArtikelController extends Controller
{
    public function index() {
        $artikels = Artikel::with('penyakit')->get();
        return view('informasi.konten-index', compact('artikels'));
    }

    public function create() {
        $penyakits = Penyakit::all();
        return view('informasi.konten-create', compact('penyakits'));
    }

public function store(Request $request) {
    $request->validate([
        'penyakit_id'    => 'required|unique:artikels,penyakit_id',
        'konten_lengkap' => 'required',
        'penanganan'     => 'required',
        'gambar'         => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
    ], [
        'penyakit_id.unique' => 'Artikel untuk penyakit ini sudah ada! Silakan pilih penyakit lain atau edit artikel yang sudah ada.',
        'gambar.max'         => 'Ukuran gambar maksimal 2MB.',
        'gambar.image'       => 'File harus berupa gambar (JPG, JPEG, PNG).'
    ]);

    $data = $request->only(['penyakit_id', 'konten_lengkap', 'penanganan']);

    if ($request->hasFile('gambar')) {
        $data['gambar'] = $request->file('gambar')->store('artikel', 'public');
    }

    Artikel::create($data);

    return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil ditambah.');
}

    // FORM EDIT ARTIKEL
    public function edit($id) {
        $artikel = Artikel::findOrFail($id);
        $penyakits = Penyakit::all();
        return view('informasi.konten-edit', compact('artikel', 'penyakits'));
    }

    // PROSES UPDATE ARTIKEL
    public function update(Request $request, $id) {
        $artikel = Artikel::findOrFail($id);

        $request->validate([
            // unique diabaikan untuk ID artikel yang sedang diedit agar tidak error
            'penyakit_id'    => 'required|unique:artikels,penyakit_id,' . $id,
            'konten_lengkap' => 'required',
            'penanganan'     => 'required',
            'gambar'         => 'image|nullable|max:2048'
        ]);

        $data = $request->all();

        // Cek jika ada gambar baru yang di-upload
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($artikel->gambar && Storage::disk('public')->exists($artikel->gambar)) {
                Storage::disk('public')->delete($artikel->gambar);
            }
            // Simpan gambar baru
            $data['gambar'] = $request->file('gambar')->store('artikel', 'public');
        }

        $artikel->update($data);
        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil diperbarui.');
    }

    // PROSES HAPUS ARTIKEL
    public function destroy($id) {
        $artikel = Artikel::findOrFail($id);

        // Hapus file gambar dari storage jika ada
        if ($artikel->gambar && Storage::disk('public')->exists($artikel->gambar)) {
            Storage::disk('public')->delete($artikel->gambar);
        }

        $artikel->delete();
        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil dihapus.');
    }
}