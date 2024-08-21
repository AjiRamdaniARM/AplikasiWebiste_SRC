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

            if ($request->ajax()) {
                $teams = DB::table('data_teams')
                    ->join('participants as p1', 'data_teams.id_participants_1', '=', 'p1.id')
                    ->join('participants as p2', 'data_teams.id_participants_2', '=', 'p2.id')
                    ->join('races as r1', 'p1.race_id', '=', 'r1.id') // Join untuk race peserta 1
                    ->join('races as r2', 'p2.race_id', '=', 'r2.id') // Join untuk race peserta 2
                    ->where('data_teams.id_user', $user)
                    ->select(
                        'data_teams.id',
                        'data_teams.nama_team',
                        'p1.name as participant1_name',
                        'p2.name as participant2_name',
                        'r1.name as participant1_race_name', // Nama race peserta 1
                        'r2.name as participant2_race_name'  // Nama race peserta 2
                    )
                    ->get();

                $data = $teams->map(function ($team) {
                    $raceMismatch = $team->participant1_race_name !== $team->participant2_race_name;
                    return [
                        'id' => $team->id,
                        'nama_team' => $team->nama_team,
                        'participant1_name' => $team->participant1_name,
                        'participant2_name' => $team->participant2_name,
                        'race_name' => $raceMismatch ? 'Tidak Sesuai' : $team->participant1_race_name,
                        'race_mismatch' => $raceMismatch
                    ];
                });

                return response()->json($data);
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
