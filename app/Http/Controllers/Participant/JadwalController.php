<?php

namespace App\Http\Controllers\Participant;

use App\Http\Controllers\Controller;
use App\Models\DataTeam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class JadwalController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::id();
        $getPeserta = DB::table('participants')
            ->join('races', 'participants.race_id', '=', 'races.id')
            ->where('id_user', $user)
            ->select('participants.name as name_peserta', 'participants.id as id_peserta', 'races.name')
            ->get();

            $getTeam = DB::table('data_teams')
            ->join('participants as p1', 'data_teams.id_participants_1', '=', 'p1.id') // Join pertama untuk peserta 1
            ->join('participants as p2', 'data_teams.id_participants_2', '=', 'p2.id') // Join kedua untuk peserta 2
            ->where('data_teams.id_user', $user)
            ->select(
                'data_teams.id',
                'data_teams.nama_team',
                'p1.name as participant1_name', // Nama peserta 1
                'p2.name as participant2_name'  // Nama peserta 2
            )
            ->get();



        if ($request->ajax()) {
            return response()->json($getTeam);
        }

        return view('dashboard.participant.jadwal.index', compact('getPeserta'));
    }
    public function postTeam(Request $request) {
        $put = new DataTeam();
        $put->id_user = Auth::user()->id;
        $put->nama_team = $request->name;
        $put->id_participants_1 = $request->id_participants_1;
        $put->id_participants_2 = $request->id_participants_2;
        $put->save();
        return response()->json($put);
    }
    public function destroy($id)
    {
        $team = DataTeam::findOrFail($id);
        $team->delete();

        return response()->json(['success' => 'Team deleted successfully.']);
    }
}
