<?php

namespace App\Http\Controllers;

use App\Models\ContactMe;
use App\Models\Directive;
use App\Models\LocationEvent;
use App\Models\Organized;
use App\Models\Race;

class HomeController extends Controller
{
    public function index()
    {
        $lokasi = LocationEvent::all();
        $item = Directive::all();
        $data = Race::all();
        $sponsor = Organized::where('type', 'sponsor')->get();
        $organize = Organized::where('type', 'organize')->get();
        $media = Organized::where('type', 'organize')->get();

        return view('welcome', compact('data', 'media', 'item', 'lokasi', 'sponsor', 'organize'));
    }

    public function show($slug)
    {
        $race = Race::where('slug', $slug)->firstOrFail();
        $con = ContactMe::first();

        return view('show', compact('race', 'con'));
    }
}
