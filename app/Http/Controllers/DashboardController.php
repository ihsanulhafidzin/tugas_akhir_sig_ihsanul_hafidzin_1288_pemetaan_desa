<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Lahan;
use App\Models\lokasi;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        $beritas = Berita::all();
        return view('dashboard', compact('beritas'));
    }

    public function map()
    {
        $lokasis = lokasi::all();

        // Pass the variable to the view
        return view('map', compact('lokasis'));
    }

    public function acara($id)
    {
        $berita = Berita::findOrFail($id);
        return view('acara', compact('berita'));
    }

    public function maphan()
    {
        $lahans = Lahan::all();
        return view('maphan', compact('lahans'));
    }
}
