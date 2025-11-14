<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Karya;
use App\Models\Kategori;
use App\Models\User;
use App\Models\Laporan;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $jumlahSeniman=User::where('role','seniman')->count();
        $jumlahKarya=Karya::count();
        $jumlahLaporan=Laporan::count();

        return view('admin.dashboard',compact('jumlahSeniman','jumlahKarya','jumlahLaporan'));
    }
    public function kelolaSeniman(){
        $seniman =User::where('role','seniman')->get();
        return view('admin.seniman.index',compact('seniman'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.seniman.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:8'
        ]);
        User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'role'=>'seniman',
            'status'=>$request->status,
            'deskripsi'=>$request->deskripsi,
        ]);
        return redirect()->route('admin.kelola')->with('seccess','Akun Seniman Berhasil Ditambahkan');
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
        $seniman=User::findOrFail($id);
        return view('admin.seniman.edit',compact('seniman'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $seniman=User::findOrFail($id);
        $seniman->update([
            'name'=>$request->name,
            'email'=>$request->email,
        ]);
        return redirect()->route('admin.kelola')->with('success','Data Seniman Berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
