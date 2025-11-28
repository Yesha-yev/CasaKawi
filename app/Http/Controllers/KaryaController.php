<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Karya;

class KaryaController extends Controller
{
    public function index()
    {
        $karya = Karya::all();
        return view('karya.index', compact('karya'));
    }
}
