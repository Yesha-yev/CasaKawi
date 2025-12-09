<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Karya;

class KaryaReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $karyas = Karya::with('seniman', 'kategori')
        ->latest()
        ->get();

        return view('karya.review', ['mode'=>'list','karyas'=>$karyas]);
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
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $karya = Karya::with('seniman', 'kategori')->findOrFail($id);

        return view('karya.review', ['mode'=>'detail','karya'=>$karya]);
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
            'status'=>'required|in:pending,approved,rejected,considered',
            'keterangan'=>'nullable|string|max:2000',
        ]);

        $karya=Karya::findOrFail($id);
        $karya->status=$request->status;
        $karya->keterangan=$request->keterangan;
        $karya->save();

        return redirect()->route('admin.karya.review')->with('success','Status karya berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
