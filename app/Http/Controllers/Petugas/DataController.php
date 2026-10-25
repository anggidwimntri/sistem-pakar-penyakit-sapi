<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Penyakit;
use App\Models\Gejala;

class DataController extends Controller
{
    public function index()
    {
        $penyakits = Penyakit::with('gejalas')->get();
        $gejalas = Gejala::all();
        return view('page.pengetahuan.data-gejala-penyakit', compact('gejalas','penyakits'));
    }
}
