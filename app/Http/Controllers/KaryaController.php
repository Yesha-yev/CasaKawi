<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KaryaController extends Controller
{
    public function index()
    {
        $karya = Karya::with(['seniman', 'timeline', 'lokasi'])->get();
        return view('karya.index', compact('karya'));
    }
}
