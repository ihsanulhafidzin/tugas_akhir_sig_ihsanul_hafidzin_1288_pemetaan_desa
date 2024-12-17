<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    // Show all berita
    public function index()
    {
        $beritas = Berita::all();
        return view('berita.index', compact('beritas'));
    }

    // Show the form for creating a new berita
    public function create()
    {
        return view('berita.create');
    }

    // Store a new berita in the database
    public function store(Request $request)
    {
        // Validasi inputan
        $request->validate([
            'berita' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Menangani upload gambar
        $gambar = null;
        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar')->store('images', 'public');
        }

        // Simpan berita ke dalam database
        Berita::create([
            'berita' => $request->berita,
            'gambar' => $gambar,
        ]);

        // Redirect kembali ke index
        return redirect()->route('berita.index');
    }

    // Show a single berita
    public function show(Berita $berita)
    {
        return view('berita.show', compact('berita'));
    }

    // Show the form for editing a berita
    public function edit(Berita $berita)
    {
        return view('berita.edit', compact('berita'));
    }

    // Update a berita in the database
    public function update(Request $request, Berita $berita)
    {
        // Validasi inputan
        $request->validate([
            'berita' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Cek apakah gambar baru diupload
        $gambar = $berita->gambar;
        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar')->store('images', 'public');
        }

        // Update berita
        $berita->update([
            'berita' => $request->berita,
            'gambar' => $gambar,
        ]);

        // Redirect kembali ke index
        return redirect()->route('berita.index');
    }

    // Delete a berita
    public function destroy(Berita $berita)
    {
        // Hapus berita
        $berita->delete();

        // Redirect kembali ke index
        return redirect()->route('berita.index');
    }
}
