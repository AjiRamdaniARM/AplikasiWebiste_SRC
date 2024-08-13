<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Participant;
use App\Models\Race;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Handle the incoming requ est.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $lv2 = User::with('roles')->role('participant')->count();
        $user = Auth::user();
        $participants = Participant::all()->count();
        $data = Race::all();
        $data2 = Race::all()->count();
        $item = Invoice::where('user_id', $user->id)->count();
        $races = Race::all()->count();

        return view('dashboard.index', compact('lv2', 'participants', 'data', 'races', 'item', 'data2'));
    }
}
