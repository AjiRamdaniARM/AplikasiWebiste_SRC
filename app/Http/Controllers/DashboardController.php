<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Notif;
use App\Models\Participant;
use App\Models\Race;
use App\Models\User;
use App\Models\Vourcher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        $participantsUser = Participant::where('id_user', $user->id)->count();
        $pesertaOnline = DB::table('participants')
            ->join('races', 'participants.race_id', '=', 'races.id')
            ->join('project_onlines', 'participants.id_upload', '=', 'project_onlines.id')
            ->where('races.category_id', 11)
            ->select('participants.*', 'participants.id as id_peserta', 'races.category_id', 'project_onlines.*', 'project_onlines.id as online_id')
            ->get();

        $data = Race::all();
        $data2 = Race::all()->count();
        $getDataInvoice = Invoice::where('user_id', $user->id)->get();

        $dataUser = DB::table('invoice_races')
            ->join('races', 'invoice_races.race_id', '=', 'races.id')
            ->whereIn('invoice_id', $getDataInvoice->pluck('id'))
            ->count();

        $item = Invoice::where('user_id', $user->id)->count();
        $itemAll = Invoice::all()->count();
        $races = Race::all()->count();
        $notif = Notif::where('id_user', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        $voucher = Vourcher::orderBy('created_at', 'desc')->get();
        // idgenerated
        $kodeVoucher = substr(bin2hex(random_bytes(5)), 0, 16);
        // Combine prefix, random string, and timestamp
        $idVoucher = 'sukarobot_'.$kodeVoucher;

        return view('dashboard.index', compact('voucher', 'lv2', 'itemAll', 'pesertaOnline', 'participants', 'data', 'data2', 'races', 'item', 'notif', 'user', 'idVoucher', 'participantsUser', 'dataUser'));
    }

    public function seleksi(Request $request, $id_peserta)
    {
        $notif = new Notif;
        // input seleksi ke database
        $seleksi = Participant::findOrFail($id_peserta);
        $get = Participant::where('id', $id_peserta)->first();
        $seleksi->id_seleksi = $request->input('seleksi');

        if ($request->input('seleksi') == 2) {
            $judul = 'belum lulus';
            $message = 'participant '.$get->name.' dinyatakan tidak lulus';
        } else {
            $judul = 'lulus';
            $message = 'participant '.$get->name.' dinyatakan lulus'; // Atau pesan default lainnya
        }
        $notif->id_user = $request->input('id_user');
        $notif->judul_notif = $judul;
        $notif->pesan = $message;
        $notif->save();
        $seleksi->save();

        return redirect()->back()->with('seleksi', $message);
    }

    public function notifDelete($id)
    {
        $notif = Notif::where('id_user', $id)->first();
        $notif->delete();

        return redirect()->back();
    }

    public function uploadProject()
    {
        $pesertaOnline = DB::table('participants')
            ->join('races', 'participants.race_id', '=', 'races.id')
            ->join('project_onlines', 'participants.id_upload', '=', 'project_onlines.id')
            ->where('races.category_id', 11)
            ->select('participants.*', 'participants.id as id_peserta', 'races.category_id', 'project_onlines.*', 'project_onlines.id as online_id', 'races.name as nama_lomba')
            ->get();

        return view('dashboard.upload.uploadProject', compact('pesertaOnline'));
    }
}
