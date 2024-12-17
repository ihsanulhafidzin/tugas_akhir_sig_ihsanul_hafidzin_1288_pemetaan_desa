<?php

namespace App\Http\Controllers;

use App\Models\Lahan;
use Illuminate\Http\Request;

class LahanController extends Controller
{
    public function index()
    {
        $lahans = Lahan::all();
        return view('lahans.index', compact('lahans'));
    }

    // Tampilkan form create
    public function create()
    {
        return view('lahans.create');
    }

    // Simpan data lahan
    public function store(Request $request)
    {
        $request->validate([
            'nama_lahan' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'geojson_data' => 'required|json'
        ]);

        Lahan::create([
            'nama_lahan' => $request->nama_lahan,
            'deskripsi' => $request->deskripsi,
            'geojson_data' => $request->geojson_data
        ]);

        return redirect()->route('lahans.index')->with('success', 'Lahan berhasil ditambahkan!');
    }

    // Tampilkan detail lahan
    public function show($id)
    {
        $lahan = Lahan::findOrFail($id); // Cari lahan berdasarkan ID
        return view('lahans.show', compact('lahan'));
    }

    // Show the form for editing a Lahan
    public function edit(Lahan $lahan)
    {
        return view('lahans.edit', compact('lahan'));
    }

    // Update the Lahan in the database
    public function update(Request $request, Lahan $lahan)
    {
        // Validate the incoming data
        $request->validate([
            'nama_lahan' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'geojson_data' => 'required|json'
        ]);

        // Update the Lahan in the database
        $lahan->update([
            'nama_lahan' => $request->nama_lahan,
            'deskripsi' => $request->deskripsi,
            'geojson_data' => $request->geojson_data
        ]);

        // Redirect to the index with a success message
        return redirect()->route('lahans.index')->with('success', 'Lahan updated successfully!');
    }

    // Delete a Lahan
    public function destroy(Lahan $lahan)
    {
        $lahan->delete();
        return redirect()->route('lahans.index')->with('success', 'Lokasi deleted successfully!');
    }

    // Show all Lahans on the map
    public function map()
    {
        $lahans = Lahan::all();
        return view('lahans.map', compact('lahans'));
    }
}
