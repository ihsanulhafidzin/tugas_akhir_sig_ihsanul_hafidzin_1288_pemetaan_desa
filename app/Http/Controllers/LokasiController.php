<?php

namespace App\Http\Controllers;

use App\Models\Lokasi;
use Illuminate\Http\Request;

class LokasiController extends Controller
{
    public function index()
    {
        $lokasis = Lokasi::all();
        return view('lokasis.index', compact('lokasis'));
    }

    public function create()
    {
        return view('lokasis.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_lokasi' => 'required|string|max:255',
            'jenis_lokasi' => 'required|in:masjid,sekolah,tempat wisata,kantor kepala desa',
            'gambar_lokasi' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'koordinat' => 'required|string|max:255',
            'deskripsi' => 'required',
        ]);

        if ($request->hasFile('gambar_lokasi')) {
            $validatedData['gambar_lokasi'] = $request->file('gambar_lokasi')->store('lokasi_images', 'public');
        }

        Lokasi::create($validatedData);

        return redirect()->route('lokasis.index')->with('success', 'Lokasi created successfully.');
    }

    public function show(Lokasi $lokasi)
    {
        return view('lokasis.show', compact('lokasi'));
    }

    public function edit(Lokasi $lokasi)
    {
        return view('lokasis.edit', compact('lokasi'));
    }

    public function update(Request $request, Lokasi $lokasi)
    {
        $validatedData = $request->validate([
            'nama_lokasi' => 'required|string|max:255',
            'jenis_lokasi' => 'required|in:masjid,sekolah,tempat wisata,kantor kepala desa',
            'gambar_lokasi' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'koordinat' => 'required|string|max:255',
            'deskripsi' => 'required',
        ]);

        if ($request->hasFile('gambar_lokasi')) {
            $validatedData['gambar_lokasi'] = $request->file('gambar_lokasi')->store('lokasi_images', 'public');
        }

        $lokasi->update($validatedData);

        return redirect()->route('lokasis.index')->with('success', 'Lokasi updated successfully.');
    }

    public function destroy(Lokasi $lokasi)
    {
        $lokasi->delete();
        return redirect()->route('lokasis.index')->with('success', 'Lokasi deleted successfully.');
    }
    public function mapall()
    {
        $lokasis = Lokasi::all();
        return view('lokasis.mapall', compact('lokasis'));
    }
}
