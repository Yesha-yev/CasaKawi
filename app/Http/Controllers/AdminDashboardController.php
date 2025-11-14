<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Karya;
use App\Models\Budaya;
use App\Models\User;
use App\Models\Laporan;

class AdminDashboardController extends Controller
{
    //
    public function index()
    {
         $jumlahSeniman = User::where('role','seniman')->count();
        $jumlahKarya = Karya::count();
        $jumlahBudaya = Budaya::count();
        $jumlahKategori = Kategori::count();
        $jumlahLaporan = Laporan::count();

        $kategoriData = Kategori::withCount('karyas')->get();

        $budayaByDaerah = Budaya::select('asal_daerah')
            ->selectRaw('COUNT(*) as total')
            ->groupBy('asal_daerah')
            ->get();

            return view('admin.dashboard', compact(
            'jumlahSeniman','jumlahKarya','jumlahBudaya','jumlahKategori','jumlahLaporan',
            'kategoriData','budayaByDaerah'
        ));
    }
}
