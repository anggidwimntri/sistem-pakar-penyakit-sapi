<?php

namespace App\Http\Controllers\Pakar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BasisPengetahuan;
use App\Models\Penyakit;
use App\Models\Gejala;

class PengetahuanController extends Controller
{
  public function index()
{
    // Mengurutkan berdasarkan ID penyakit (penyakit_id)
    $pengetahuans = BasisPengetahuan::with(['penyakit', 'gejala'])
        ->get()
        ->sortBy('penyakit_id');

    return view('page.pengetahuan.index', compact('pengetahuans'));
}

    public function create()
    {
        $penyakits = Penyakit::all();
        $gejalas = Gejala::all();
        return view('page.pengetahuan.create', compact('penyakits', 'gejalas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'penyakit_id' => 'required',
            'gejala_id'   => 'required',
            'mb'          => 'required|numeric|min:0|max:1',
            'md'          => 'required|numeric|min:0|max:1',
        ]);

        // Otomatis hitung nilai CF Pakar = MB - MD
        $mb = $request->mb;
        $md = $request->md;
        $cf_pakar = $mb - $md;

        BasisPengetahuan::create([
            'penyakit_id' => $request->penyakit_id,
            'gejala_id'   => $request->gejala_id,
            'mb'          => $mb,
            'md'          => $md,
            'cf_pakar'    => $cf_pakar,
        ]);

        return redirect()->route('pakar.pengetahuan.index')->with('success', 'Basis pengetahuan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $pengetahuan = BasisPengetahuan::findOrFail($id);
        $penyakits = Penyakit::all();
        $gejalas = Gejala::all();
        return view('page.pengetahuan.edit', compact('pengetahuan', 'penyakits', 'gejalas'));
    }

    public function update(Request $request, $id)
    {
        $pengetahuan = BasisPengetahuan::findOrFail($id);

        $request->validate([
            'penyakit_id' => 'required',
            'gejala_id'   => 'required',
            'mb'          => 'required|numeric|min:0|max:1',
            'md'          => 'required|numeric|min:0|max:1',
        ]);

        $mb = $request->mb;
        $md = $request->md;
        $cf_pakar = $mb - $md;

        $pengetahuan->update([
            'penyakit_id' => $request->penyakit_id,
            'gejala_id'   => $request->gejala_id,
            'mb'          => $mb,
            'md'          => $md,
            'cf_pakar'    => $cf_pakar,
        ]);

        return redirect()->route('pakar.pengetahuan.index')->with('success', 'Basis pengetahuan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pengetahuan = BasisPengetahuan::findOrFail($id);
        $pengetahuan->delete();

        return redirect()->route('pakar.pengetahuan.index')->with('success', 'Basis pengetahuan berhasil dihapus.');
    }
}