<?php

namespace App\Http\Controllers\export;

use App\Exports\ParticipantExport;
use App\Http\Controllers\Controller;
use App\Models\Race;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    // === function export data participants excel === //
    public function excel($id) {
        // === jalankan sistem export data dari library === //
        return Excel::download(new ParticipantExport($id), 'participants.xlsx');
    }

    // === function export data participants pdf === //
    public function pdf($id) {
        $race = Race::where('id', $id)->first();
        $participants = DB::table('participants')
        ->join('invoices', 'participants.invoice_id', '=', 'invoices.id')
        ->join('users', 'invoices.user_id', '=', 'users.id')
        ->where('participants.race_id', $id)
        ->select('users.community', 'participants.name as peserta', 'users.address as maps')
        ->get(); // === gunakan get() untuk mendapatkan semua data === //

    // === Siapkan data yang akan dikirim ke view === //
    $data = [
        'name' => $race->name,
        'participants' => $participants
    ];

        $pdf = Pdf::loadView('components/export/pdf', $data);

        return $pdf->stream('laporan.pdf');
    }
}
