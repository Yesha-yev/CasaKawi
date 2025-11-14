<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Budaya;
use App\Models\Kategori;

class BudayaController extends Controller
{
    //
    public function statistik()
    {
        $kategoriData = Kategori::withCount('karyas')->get();
        return view('admin.statistik', compact('kategoriData'));
    }
}
