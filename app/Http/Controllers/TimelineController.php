<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Timeline;

class TimelineController extends Controller
{
    public function index()
    {
        $timelines = Timeline::orderBy('event_date')->get();
        return view('public.timeline.index', compact('timelines'));
    }
}
