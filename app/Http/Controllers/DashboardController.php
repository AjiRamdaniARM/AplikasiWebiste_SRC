<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Notif;
use App\Models\Participant;
use App\Models\ProjectOnlines;
use App\Models\Race;
use App\Models\User;
use App\Models\Vourcher;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Midtrans\Config;

class DashboardController extends Controller
{
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
            ->select('participants.*', 'participants.id as id_peserta', 'races.category_id', 'races.id as race_id', 'project_onlines.*', 'project_onlines.id as online_id','participants.id_user as userID')
            ->get();

        $getSeleksiUpload = ProjectOnlines::where('seleksi', 2)->get();

        $data = Race::all();
        $data2 = Race::all()->count();
        $getDataInvoice = Invoice::where('user_id', $user->id)->get();

        $dataUser = DB::table('invoice_races')
            ->join('races', 'invoice_races.race_id', '=', 'races.id')
            ->whereIn('invoice_id', $getDataInvoice->pluck('id'))
            ->count();

            $getDataSeleksiPay = DB::table('participants')
            ->join('invoices', 'participants.invoice_seleksi_2' , '=','invoices.name')
            ->where('id_user', '=', $user->id)
            ->where('invoices.id_seleksi', 1)
            ->first();

        $item = Invoice::where('user_id', $user->id)->count();
        $itemAll = Invoice::all()->count();
        $races = Race::all()->count();
        $getRaceOnline = Race::where('category_id', 11)->get();
        $notif = Notif::where('id_user', $user->id)->first();
        $getParticipantSeleksi2 = Participant::where('id_user', $user->id)->first();
        $message = null;
        if (is_null($notif)) {
            $message = 'Data not found';
        }
        $voucher = Vourcher::orderBy('created_at', 'desc')->get();
        $kodeVoucher = substr(bin2hex(random_bytes(5)), 0, 16);
        $idVoucher = 'sukarobot_'.$kodeVoucher;

        // == ajax response json input form == //
        $count = ProjectOnlines::where('seleksi',2)->count();
        if ($request->ajax()) {
        return response()->json(['total' => $count]);
        }

        return view('dashboard.index', compact('voucher', 'lv2', 'itemAll', 'pesertaOnline', 'participants', 'data', 'data2', 'races', 'item', 'notif', 'user', 'idVoucher', 'participantsUser', 'dataUser', 'getRaceOnline', 'getParticipantSeleksi2','getDataSeleksiPay', 'getSeleksiUpload'));
    }

    public function seleksi(Request $request, $id_peserta)
    {
        // === Input seleksi ke database === //
        $pesertaOnline = DB::table('participants')
            ->join('races', 'participants.race_id', '=', 'races.id')
            ->where('participants.id', $id_peserta)
            ->select('participants.*', 'participants.id as id_peserta', 'races.category_id', 'races.name as nama_lomba', 'races.id as id_race')
            ->first();

        $seleksi = Participant::findOrFail($id_peserta);
        $race = Race::where('category_id', 11)->first(); // Mengambil objek race
        $get = Participant::where('id', $id_peserta)->first();
        $seleksi->id_seleksi = $request->input('seleksi');
        $notif = Notif::where('id_user', $request->id_user)->where('id_peserta', $id_peserta)->first();

        if (is_null($notif)) {
            $notif = new Notif;
            $notif->id_user = $request->id_user;
            $notif->id_peserta = $id_peserta;
        }

        if ($request->input('seleksi') == 2) {
            $judul = 'belum lulus';
            $message = 'Participant '.$get->name.' dinyatakan tidak lulus';
            $notif->status = 'tidak ada';
        } else {
            if (empty($race->idr_seleksi)) {
                $judul = 'lulus';
                $message = 'Participant '.$get->name.' dinyatakan lulus';
                $notif->status = 'ada';
            } else {
                $idGenerate = IdGenerator::generate(['table' => 'invoices', 'field' => 'name', 'length' => 10, 'prefix' => 'INV-']);
                $jumlahPrice = $race->idr_seleksi;

                DB::beginTransaction();
                try {
                    $invoice = Invoice::create([
                        'user_id' => $request->id_user,
                        'name' => $idGenerate,
                        'jumlah' => 1,
                    ]);

                    $invoice->itemRace()->attach($pesertaOnline->id_race); // Menggunakan ID race yang sesuai
                    DB::commit();
                    $user = User::where('id', $request->id_user)->first();

                    // Set konfigurasi Midtrans
                    Config::$serverKey = config('midtrans.serverKey');
                    Config::$isProduction = config('midtrans.isProduction');
                    Config::$isSanitized = config('midtrans.isSanitized');
                    Config::$is3ds = config('midtrans.is3ds');

                    $params = [
                        'transaction_details' => [
                            'order_id' => rand(),
                            'gross_amount' => $jumlahPrice,
                        ],
                        'customer_details' => [
                            'first_name' => $user->name,
                            'email' => $user->email,
                        ],
                    ];

                    $snapToken = \Midtrans\Snap::getSnapToken($params);
                    $invoice->snap_token = $snapToken;
                    $invoice->id_seleksi = $request->seleksi;
                    $invoice->save();

                    $get->invoice_seleksi_2 = $idGenerate;
                    $get->save();

                    $message = 'Participant '.$get->name.' dinyatakan lulus dan invoice berhasil dibuat.';
                } catch (\Exception $e) {
                    DB::rollBack();

                    return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat memproses invoice.']);
                }
            }
        }

        $notif->save();
        $seleksi->save();

        return redirect()->back()->with('seleksi', $message);
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


    public function paySeleksi(Request $request)
    {
        $put = Race::where('id', $request->race_id)->firstOrFail();
        $put->idr_seleksi = $request->pay_idr;
        $put->save();

        return back();
    }
}
