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
        $data = Race::with('category')->get();
        $data = $data->sortByDesc(function ($race) {
            return $race->category->name === 'offline';
        });
        $sponsor = Organized::where('type', 'sponsor')->get();
        $organize = Organized::where('type', 'organize')->get();
        $mediapartner = Organized::where('type', 'media_partner')->get();

        return view('welcome', compact('data', 'item', 'lokasi', 'sponsor', 'organize', 'mediapartner'));
    }

    public function show($slug)
    {
        $race = Race::where('slug', $slug)->firstOrFail();
        $con = ContactMe::first();

        return view('show', compact('race', 'con'));
    }
}
