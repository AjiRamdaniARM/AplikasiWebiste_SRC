<?php

namespace App\Http\Controllers\Participant;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $inv = Invoice::with(['participants', 'itemRace'])->findOrFail($id);
        if ($inv->participants->isEmpty()) {
            return view('dashboard.participant.team.create', compact('inv'));
        } elseif (! $inv->participants->isEmpty()) {
            return view('dashboard.participant.team.index', compact('inv'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $request->validate([
            'participants' => ['required', 'array', 'min:1'],
        ]);
        $inv = Invoice::findOrFail($id);
        try {
            foreach ($request->participants as $key => $races) {
                foreach ($races as $participant) {
                    $inv->participants()->create([
                        'race_id' => $key,
                        'name' => $participant,
                    ]);
                }
            }

            alert()->success('Success', 'Add participant');

            return redirect()->route('participant.invoice.team.index', $id);
        } catch (\Exception $th) {
            alert()->error('Oops !!', 'Failed add participant');

            return redirect()->route('participant.invoice.team.index', $id);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
