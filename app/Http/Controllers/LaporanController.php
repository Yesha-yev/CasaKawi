<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan;

class LaporanController extends Controller
{
    //
    public function index()
    {
        $laporans = Laporan::latest()->get();
        return view('admin.laporan.index', compact('laporans'));
    }
}
