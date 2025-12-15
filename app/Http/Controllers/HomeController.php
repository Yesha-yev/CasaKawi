<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Budaya;
use App\Models\Karya;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    //
    public function index()
    {
        $kategoriData = Kategori::withCount('karyas')->get();
        $budaya = Budaya::whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->get(['id','nama','asal_daerah','latitude','longitude','deskripsi'])
            ->map(function($item) {
                return [
                    'id' => 'budaya-'.$item->id,
                    'nama' => $item->nama,
                    'asal_daerah' => $item->asal_daerah,
                    'latitude' => $item->latitude,
                    'longitude' => $item->longitude,
                    'deskripsi' => $item->deskripsi,
                    'type' => 'budaya'
                ];
            });

        $karya = Karya::whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->get(['id','nama_karya','asal_daerah','latitude','longitude','deskripsi'])
            ->map(function($item) {
                return [
                    'id' => 'karya-'.$item->id,
                    'nama' => $item->nama_karya,
                    'asal_daerah' => $item->asal_daerah,
                    'latitude' => $item->latitude,
                    'longitude' => $item->longitude,
                    'deskripsi' => $item->deskripsi,
                    'type' => 'karya'
                ];
            });

        $lokasi = $budaya->merge($karya);

        return view('landing', compact('kategoriData','lokasi'));
    }
}
