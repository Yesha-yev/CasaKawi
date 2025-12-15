<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Budaya;
use App\Models\Kategori;

class BudayaController extends Controller
{
    public function index()
    {
        $budaya = Budaya::all();
        return view('budaya.index', compact('budaya'));
    }
    public function create(){
        $kategori = Kategori::all();
        return view('admin.budaya.create', ['kategoris'=>$kategori]);
    }
    public function store(Request $request){
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'asal_daerah' => 'required|string',
            'kategori' => 'required|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'gambar' => 'nullable|image|max:2048',
        ]);

        $path = null;
        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('budaya', 'public');
        }
        Budaya::create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'asal_daerah' => $request->asal_daerah,
            'kategori' => $request->kategori,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'gambar' => $path,
        ]);

        return redirect()->route('budaya.index')->with('success', 'Budaya berhasil ditambahkan.');
    }
    public function destroy($id){
        $budaya = Budaya::findOrFail($id);
        $budaya->delete();

        return redirect()->route('budaya.index')->with('success', 'Budaya berhasil dihapus.');
    }
    public function edit($id){
        $budaya = Budaya::findOrFail($id);
        $kategori = Kategori::all();
        return view('admin.budaya.edit', ['budaya'=>$budaya,'kategori'=>$kategori]);
    }
    public function update(Request $request, $id){
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'asal_daerah' => 'required|string',
            'kategori' => 'required|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'gambar' => 'nullable|image|max:2048',
        ]);

        $budaya = Budaya::findOrFail($id);
        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('budaya', 'public');
            $budaya->gambar = $path;
        }

        $budaya->nama = $request->nama;
        $budaya->deskripsi = $request->deskripsi;
        $budaya->asal_daerah = $request->asal_daerah;
        $budaya->kategori = $request->kategori;
        $budaya->latitude = $request->latitude;
        $budaya->longitude = $request->longitude;

        $budaya->save();

        return redirect()->route('budaya.index')->with('success', 'Budaya berhasil diperbarui.');
    }
}
