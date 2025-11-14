<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;

class AdminDashboardController extends Controller
{
    //
    public function index()
    {
        $kategoriData = Kategori::withCount('karyas')->get();

        return view('admin.dashboard', compact('kategoriData'));
    }
}
