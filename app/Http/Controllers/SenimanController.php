<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SenimanController extends Controller
{
    //
    public function index()
    {
        $senimans = User::where('role','seniman')->get();
        return view('admin.seniman.index', compact('senimans'));
    }

    public function create()
    {
        return view('admin.seniman.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|confirmed|min:8',
            'status'=>'nullable|in:0,1'
        ]);

        User::create([
            'name'=>$data['name'],
            'email'=>$data['email'],
            'password'=>Hash::make($data['password']),
            'role'=>'seniman',
            'status'=>isset($data['status']) ? (bool)$data['status'] : true,
        ]);

        return redirect()->route('admin.seniman.index')->with('success','Seniman ditambahkan.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.seniman.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $data = $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users,email,'.$user->id,
            'password'=>'nullable|confirmed|min:8',
            'status'=>'nullable|in:0,1'
        ]);

        $user->name = $data['name'];
        $user->email = $data['email'];
        if (!empty($data['password'])) {
            $user->password = Hash::make($data['password']);
        }
        if (isset($data['status'])) $user->status = $data['status'];
        $user->save();

        return redirect()->route('admin.seniman.index')->with('success','Seniman diperbarui.');
    }

    public function createKarya(){
        return view('seniman.karya.create');
    }
    public function destroy($id){
        $user = User::findOrFail($id);

        if ($user->karyas()->count() > 0) {
            return back()->with('error','Tidak bisa menghapus: seniman memiliki karya.');
        }

        $user->delete();
        return back()->with('success','Seniman dihapus.');
    }
    public function dashboard()
    {
        $user = auth()->user();
        $karyas = $user->karyas()->latest()->get();
        $jumlahKarya = $karyas->count();
        return view('seniman.dashboard', compact('user','karyas','jumlahKarya'));
    }
}
