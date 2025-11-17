<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Karya;
use App\Models\Kategori;
use App\Models\User;
use App\Models\Laporan;
use App\Models\Budaya;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $jumlahSeniman = User::where('role', 'seniman')->count();
        $jumlahKarya = Karya::count();
        $jumlahBudaya = Budaya::count();
        $jumlahKategori = Kategori::count();
        $jumlahLaporan = Laporan::count();

        $kategoriData = Kategori::withCount('karyas')->get();

        $budayaByDaerah = Budaya::select('asal_daerah', DB::raw('COUNT(*) as total'))
            ->groupBy('asal_daerah')
            ->get();

        return view('admin.dashboard', compact(
            'jumlahSeniman',
            'jumlahKarya',
            'jumlahBudaya',
            'jumlahKategori',
            'jumlahLaporan',
            'kategoriData',
            'budayaByDaerah'
        ));
    }

    public function statistik()
    {
        $kategoriData = Kategori::withCount('karyas')->get();
        $budayaByDaerah = Budaya::select('asal_daerah', DB::raw('COUNT(*) as total'))
            ->groupBy('asal_daerah')
            ->get();

        $laporanStats = Laporan::select('status', DB::raw('COUNT(*) as total'))
            ->groupBy('status')
            ->pluck('total','status')->toArray();

            return view('admin.statistik.index', compact(
                'kategoriData',
                'budayaByDaerah',
                'laporanStats'
            ));
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
