<?php

namespace App\Http\Controllers\Participant;

use App\Http\Controllers\Controller;

class Certificate extends Controller
{
    public function certificate()
    {
        return view('dashboard.certificate.index');
    }
}
