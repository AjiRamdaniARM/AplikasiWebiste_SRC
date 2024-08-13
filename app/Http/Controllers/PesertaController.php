<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Participant;
use App\Models\Race;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PesertaController extends Controller
{
    public function adminParticipants(Request $request)
    {
        $user = Auth::user();
        $race = Race::withCount('participants')->get();

        // === Gabungkan data === //

        $invoices = Invoice::all();
        $participantsQuery = Participant::whereIn('invoice_id', $invoices->pluck('id'));

        // Filter by race
        if ($request->has('race') && $request->race != '') {
            $participantsQuery->where('race_id', $request->race);
        }

        $participants = $participantsQuery->get();

        if ($request->ajax()) {
            return view('dashboard.participant.peserta.participant_list', compact('participants'))->render();
        }

        return view('dashboard.participant.peserta.index', compact('race', 'participants'));
    }
}
