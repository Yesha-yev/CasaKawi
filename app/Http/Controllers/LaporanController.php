<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $status = $request->status ?? 'pending';
        $laporan = Laporan::where('status', $status)->get();
        return view('admin.laporan.index',compact('laporan','status'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'pesan' => 'required|string',
        ]);
        Laporan::create([
            'nama'=>$request->input('nama'),
            'email'=>$request->input('email'),
            'pesan'=>$request->input('pesan'),
            'status'=>'pending',
        ]);
        return back()->with('success','Laporan berhasil dikirim');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateStatus(Request $request, string $id)
    {
        //
        $request->validate([
            'status'=>'required|in:pending,proses,selesai'
        ]);
        $laporan=Laporan::findOrFail($id);
        $laporan->status=$request->input('status');
        $laporan->save();
        return back()->with('success','Status laporan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $laporan =Laporan::findOrFail($id);
        $laporan->delete();
        return back()->with('success','Laporan berhasil dihapus');
    }
}
