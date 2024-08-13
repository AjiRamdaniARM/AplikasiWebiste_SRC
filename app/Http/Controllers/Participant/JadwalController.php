<?php

namespace App\Http\Controllers\Participant;

use App\Http\Controllers\Controller;

class JadwalController extends Controller
{
    public function index()
    {
        return view('dashboard.participant.jadwal.index');
    }
}
