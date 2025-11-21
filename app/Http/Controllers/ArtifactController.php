<?php

namespace App\Http\Controllers;

use App\Models\Artifact;


class ArtifactController extends Controller
{
    public function index()
    {
        $artifacts = Artifact::all();
        return view('public.artifacts.index', compact('artifacts'));
    }

    public function show($id)
    {
        $artifact = Artifact::findOrFail($id);
        return view('public.artifacts.show', compact('artifact'));
    }

    public function map()
    {
        $locations = Artifact::select('id','name','latitude','longitude')->get();
        return view('public.artifacts.map', compact('locations'));
    }
}
