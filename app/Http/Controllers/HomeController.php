<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Budaya;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    //
    public function index()
    {
        //hitung jumlah karya per kategori pakai withCount
        $kategoriData = Kategori::withCount('karyas')->get();
        // nama label untuk chart
        $lokasi = Budaya::whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->get(['id','nama','asal_daerah','latitude','longitude','deskripsi']);

        return view('landing', compact('kategoriData','lokasi'));
    }
}
