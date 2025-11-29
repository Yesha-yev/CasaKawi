<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Karya;
use App\Models\Kategori;
use Illuminate\Support\Facades\Hash;

class SenimanController extends Controller
{
    private function generateAudio($text, $fileName)
    {
        $folder = public_path('uploads/audio');

        if (!file_exists($folder)) {
            mkdir($folder, 0777, true);
        }

        $outputPath = $folder . '/' . $fileName . '.mp3';
        $gtts = 'C:/laragon/bin/python/python-3.10/Scripts/gtts-cli.exe';
        $command = "\"$gtts\" --lang id --slow \"$text\" -o \"$outputPath\"";
        exec($command . " 2>&1", $output, $returnCode);

        if ($returnCode !== 0) {
            logger()->error('GTTS ERROR', ['cmd' => $command, 'output' => $output]);
            return false;
        }

        return 'uploads/audio/' . $fileName . '.mp3';
    }

    public function index()
    {
        $senimans = User::where('role', 'seniman')->get();
        return view('admin.seniman.index', compact('senimans'));
    }

    public function create()
    {
        return view('admin.seniman.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:8',
            'status' => 'nullable|in:0,1'
        ]);

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'seniman',
            'status' => $data['status'] ?? 1,
        ]);

        return redirect()->route('admin.seniman.index')->with('success', 'Seniman berhasil ditambahkan.');
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
            'name' => 'required|string|unique:users,name,' . $user->id,
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|confirmed|min:8',
            'status' => 'nullable|in:0,1'
        ]);

        $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => !empty($data['password']) ? Hash::make($data['password']) : $user->password,
            'status' => $data['status'] ?? $user->status,
        ]);

        return redirect()->route('admin.seniman.index')->with('success', 'Seniman berhasil diperbarui.');
    }

    public function dashboard()
    {
        $senimanId = auth()->id();
        
        $total = Karya::where('seniman_id', $senimanId)->count();
        $approved = Karya::where('seniman_id', $senimanId)->where('status', 'approved')->count();
        $pending = Karya::where('seniman_id', $senimanId)->where('status', 'pending')->count();
        $rejected = Karya::where('seniman_id', $senimanId)->where('status', 'rejected')->count();
        $considered = Karya::where('seniman_id', $senimanId)->where('status', 'considered')->count();

        return view('seniman.dashboard', compact('total', 'approved', 'pending', 'rejected', 'considered'
        ));
    }



    public function editProfil()
    {
        $user = auth()->user();
        return view('seniman.profil.edit', compact('user'));
    }

    public function updateProfil(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6'
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('seniman.profil.edit')->with('success', 'Profil berhasil diperbarui!');
    }

    public function indexKarya()
    {
        $karyas = Karya::where('seniman_id', auth()->id())->latest()->get();
        return view('seniman.karya.index', compact('karyas'));
    }

    public function createKarya()
    {
        $kategoris = Kategori::all();
        return view('seniman.karya.create', compact('kategoris'));
    }

    public function storeKarya(Request $request)
    {
        $data = $request->validate([
            'nama_karya' => 'required|string',
            'tahun_dibuat' => 'nullable|integer',
            'asal_daerah' => 'required|string',
            'kategori_id' => 'required|exists:kategoris,id',
            'deskripsi' => 'nullable|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $namaFile = time() . '-' . $file->getClientOriginalName();
            $file->move(public_path('uploads/karya'), $namaFile);
            $data['gambar'] = 'uploads/karya/' . $namaFile;
        }

        $data['seniman_id'] = auth()->id();

        if (!empty($data['deskripsi'])) {
            $audioFile = $this->generateAudio($data['deskripsi'], 'karya_' . time());
            if ($audioFile) $data['audio'] = $audioFile;
        }
        Karya::create($data);

        return redirect()->route('seniman.karya.index')->with('success', 'Karya berhasil dibuat.');
    }

    public function editKarya($id)
    {
        $karya = Karya::where('seniman_id', auth()->id())->findOrFail($id);
        $kategori = Kategori::all();

        return view('seniman.karya.edit', compact('karya', 'kategori'));
    }

    public function updateKarya(Request $request, $id)
    {
        $karya = Karya::where('seniman_id', auth()->id())->findOrFail($id);

        $data = $request->validate([
            'nama_karya' => 'required|string',
            'tahun_dibuat' => 'nullable|integer',
            'asal_daerah' => 'required|string',
            'kategori_id' => 'required|exists:kategoris,id',
            'deskripsi' => 'nullable|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        if ($request->hasFile('gambar')) {
            if ($karya->gambar && file_exists(public_path($karya->gambar))) {
                unlink(public_path($karya->gambar));
            }

            $file = $request->file('gambar');
            $namaFile = time() . '-' . $file->getClientOriginalName();
            $file->move(public_path('uploads/karya'), $namaFile);
            $data['gambar'] = 'uploads/karya/' . $namaFile;
        }

        if (!empty($data['deskripsi']) && $data['deskripsi'] !== $karya->deskripsi) {
            $audioFile = $this->generateAudio($data['deskripsi'], 'karya_' . $karya->id . '_' . time());

            if ($audioFile) {
                if ($karya->audio && file_exists(public_path($karya->audio))) {
                    unlink(public_path($karya->audio));
                }
                $data['audio'] = $audioFile;
            }
        }

        $karya->update($data);

        return redirect()->route('seniman.karya.index')->with('success', 'Karya berhasil diperbarui.');
    }

    public function deleteKarya($id)
    {
        $karya = Karya::where('seniman_id', auth()->id())->findOrFail($id);

        if ($karya->gambar && file_exists(public_path($karya->gambar))) unlink(public_path($karya->gambar));
        if ($karya->audio && file_exists(public_path($karya->audio))) unlink(public_path($karya->audio));

        $karya->delete();

        return redirect()->route('seniman.karya.index')->with('success', 'Karya berhasil dihapus.');
    }
}
