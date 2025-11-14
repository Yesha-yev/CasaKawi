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
            'password'=>'required|confirmed|min:6',
            'status'=>'nullable|in:0,1'
        ]);

        User::create([
            'name'=>$data['name'],
            'email'=>$data['email'],
            'password'=>Hash::make($data['password']),
            'role'=>'seniman',
            'status'=>$data['status'] ?? 1,
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
            'password'=>'nullable|confirmed|min:6',
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

    public function dashboard()
    {
        $user = auth()->user();
        $karyas = $user->karyas()->latest()->get();
        return view('seniman.dashboard', compact('user','karyas'));
    }
}
