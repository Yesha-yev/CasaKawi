<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Karya;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    //
    public function index()
    {
        //hitung jumlah karya per kategori pakai withCount
        $kategoriData = Kategori::withCount('karya')->get();
        // nama label untuk chart
        $labels = $kategoriData->pluck('nama_kategori');       // array nama kategori
        $values = $kategoriData->pluck('karya_count');         // array jumlah karya tiap kategori

        return view('landing', compact('labels','values'));
    }
}
