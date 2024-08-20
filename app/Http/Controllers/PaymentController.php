<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Participant;
use App\Models\Race;
use App\Models\Vourcher;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function pay(Request $request, $id, $name)
    {
        $data = Race::find($id);
        $inv = Invoice::where('name', $name)->firstOrFail();
        $inv->status = $request->status;
        $inv->save();

        return redirect('payment/'.$id)
            ->with('pending', 'Pending')
            ->with('participants', 'Sudah Upload')
            ->with('message', 'Pembelian perlombaan selesai');
    }

    public function pay2(Request $request, $id)
    {
        $inv = Invoice::findOrFail($id);
        $inv->status = $request->input('status');
        $inv->save();

        return redirect()->back()
            ->with('success', 'Pembelian perlombaan selesai')
            ->with('participants', 'Tambahkan peserta');
    }

    public function PaySeleksi2(Request $request, $id)
    {
        $inv = Invoice::findOrFail($id);
        $inv->status = $request->input('status');
        $inv->save();

        return redirect()->back();
    }

    public function participants(Request $request, $id)
    {
        $user = Auth::id();
        $invoiceIds = $request->input('invoice_id', []);
        $raceIds = $request->input('race_id', []);
        $names = $request->input('name', []);
        $kelas = $request->input('kelas', []);
        $idUser = $request->input('id_user', []);

        // === get data dari 3 table dan gabung === //
        $race = DB::table('invoice_races')
            ->join('invoices', 'invoice_races.invoice_id', '=', 'invoices.id')
            ->join('races', 'invoice_races.race_id', '=', 'races.id')
            ->where('invoice_races.invoice_id', $id)
            ->orderBy('invoices.created_at', 'desc')
            ->select('invoices.*', 'invoice_races.*', 'races.name as race_name')
            ->first();

        $count = count($invoiceIds);
        if ($count != count($raceIds) || $count != count($names) || $count != count($kelas) || $count != count($idUser)) {
            return back()->withErrors(['message' => 'Jumlah elemen dalam setiap input harus sama.']);
        }

        // === Simpan data ke database === //
        for ($i = 0; $i < $count; $i++) {
            $shortName = substr($race->race_name, 0, 5); // === Mengambil 5 karakter pertama dari nama === //

            $id = IdGenerator::generate(['table' => 'participants', 'field' => 'IdCard', 'length' => 10, 'prefix' => $shortName.'-']);
            Participant::create([
                'invoice_id' => $invoiceIds[$i],
                'race_id' => $raceIds[$i],
                'name' => $names[$i],
                'kelas' => $kelas[$i],
                'IdCard' => $id,
                'id_user' => $idUser[$i],
            ]);
        }

        // === Redirect atau tampilkan pesan sukses === //
        return back()->with('message', 'Data peserta berhasil disimpan.');
    }

    public function participants2(Request $request, $id)
    {
        // === Ambil data input dari request === //
        $invoiceIds = $request->input('invoice_id', []);
        $raceIds = $request->input('race_id', []);
        $names = $request->input('name', []);
        $kelas = $request->input('kelas', []);
        $idUser = $request->input('id_user', []);

        // === get data dari 3 table dan gabung === //
        $race = DB::table('invoice_races')
            ->join('invoices', 'invoice_races.invoice_id', '=', 'invoices.id')
            ->join('races', 'invoice_races.race_id', '=', 'races.id')
            ->where('invoice_races.invoice_id', $id)
            ->orderBy('invoices.created_at', 'desc')
            ->select('invoices.*', 'invoice_races.*', 'races.name as race_name')
            ->first();

        $count = count($invoiceIds);
        if ($count != count($raceIds) || $count != count($names) || $count != count($kelas) || $count != count($idUser)) {
            return back()->withErrors(['message' => 'Jumlah elemen dalam setiap input harus sama.']);
        }

        // === Simpan data ke database === //
        for ($i = 0; $i < $count; $i++) {
            $shortName = substr($race->race_name, 0, 5); // Mengambil 5 karakter pertama dari nama

            $id = IdGenerator::generate(['table' => 'participants', 'field' => 'IdCard', 'length' => 10, 'prefix' => $shortName.'-']);

            Participant::create([
                'invoice_id' => $invoiceIds[$i],
                'race_id' => $raceIds[$i],
                'name' => $names[$i],
                'kelas' => $kelas[$i],
                'IdCard' => $id,
                'id_user' => $idUser[$i],
            ]);
        }

        return back()->with('success', 'Data berhasil disimpan.');
    }

    public function diskon(Request $request, $id)
    {
        DB::transaction(function () use ($id, $request, &$message) {
            // === validasi pertama === //
            $invoice = Invoice::findOrFail($id);
            $getKode = Vourcher::where('code', $request->code)->first();

            if (! $getKode) {
                // === Set nilai diskon invoice menjadi null === //
                $invoice->diskon = null;

                // === Set pesan untuk modal === //
                $message = 'open-modal-nothing';

                return $message;
            }

            if ($getKode->status == 'active') {
                // === Update nilai diskon pada invoice === //
                $invoice->diskon = $getKode->diskon; // === pastikan $request->diskon benar-benar ada === //
                $message = 'open-modal-berhasil';
            } elseif ($getKode->status == 'incative') { // ===  Typo: 'incative' seharusnya 'inactive' === //
                $invoice->diskon = null;
                $message = 'open-modal';
            }

            $invoice->save();
            // ===  validasi kedua === //
            $getKode->status = 'incative'; // === Typo: 'incative' seharusnya 'inactive' === //
            $getKode->save();
        });

        return redirect()->back()->with('diskon', $message);
    }
}
