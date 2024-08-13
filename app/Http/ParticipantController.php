<?php

namespace App\Http\Controllers;

use App\Exports\ParticipantExport;
use App\Models\Invoice;
use App\Models\Participant;
use App\Models\Race;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ParticipantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $race)
    {
        $cont = Race::findOrFail($race);

        return view('dashboard.race.participant.index', compact('cont', 'participants'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $race = Race::with(['participants'])->findOrFail($id);

        return Excel::download(new ParticipantExport($race->id), $race->slug.'.xlsx');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function peserta($id)
    {

        $getPesertaLomba = DB::table('participants')
            ->join('invoices', 'participants.invoice_id', '=', 'invoices.id')
            ->join('users', 'invoices.user_id', '=', 'users.id')
            ->where('participants.race_id', $id)
            ->select('participants.*', 'participants.name as peserta', 'invoices.name as invoice_nama', 'users.*')
            ->get();
        // $getPesertaLomba = Participant::where('race_id', $id)->get();

        return view('dashboard.participant.peserta.pesertaLomba', compact('getPesertaLomba'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $user = Auth::user();
        $race = Race::all();
        $invoices = Invoice::where('user_id', $user->id)->get();
        $invoiceIds = $invoices->pluck('id')->toArray();

        $participants = Participant::whereIn('invoice_id', $invoiceIds)
            ->with(['race.category', 'projectonlines'])
            ->get();

        // // Filter by race
        // if ($request->has('race') && $request->race != '') {
        //     $participantsQuery->where('race_id', $request->race);
        // }

        // $participants = $participantsQuery->get();

        // if ($request->ajax()) {
        //     return view('dashboard.participant.show.participant_list', compact('participants'))->render();
        // }

        return view('dashboard.participant.show.index', compact('race', 'participants'));
    }

    public function editParticipants(Request $request, $id)
    {
        // Fetch the participant by ID
        $participant = Participant::findOrFail($id);

        // Update participant attributes with data from the request
        $participant->name = $request->name;
        $participant->kelas = $request->kelas;

        // Save the updated participant
        $participant->save();

        return redirect()->back()->with('message', 'Data berhasil di edit');

    }

    public function delete($id)
    {
        $getParticipants = Participant::findOrFail($id);
        $getParticipants->delete();

        return redirect()->back()->with('message', 'Data berhasil di delete');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
