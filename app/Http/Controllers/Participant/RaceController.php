<?php

namespace App\Http\Controllers\Participant;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RaceController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $invoices = Invoice::where('user_id', $user->id)->get();

        $invoiceIds = $invoices->pluck('id')->toArray();

        $races = DB::table('invoice_races')
            ->join('invoices', 'invoice_races.invoice_id', '=', 'invoices.id')
            ->join('races', 'invoice_races.race_id', '=', 'races.id')
            ->whereIn('invoice_races.invoice_id', $invoiceIds)
            ->select('invoices.*', 'invoice_races.*', 'races.*')
            ->get();

        return view('dashboard.participant.race.index', compact('races'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'races' => ['required', 'array', 'min:1'],
        ]);

        $id = IdGenerator::generate(['table' => 'invoices', 'field' => 'name', 'length' => 10, 'prefix' => 'INV-']);
        try {
            DB::beginTransaction();
            $invoice = Invoice::create([
                'user_id' => auth()->id(),
                'name' => $id,
            ]);

            $invoice->itemRace()->attach($request->races);

            DB::commit();

            alert()->success('Success', 'To make invoice, please paid it !!');

            return response()->json([
                'success' => true,
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();

            alert()->error('Failed', 'To make invoice, please try again !!');

            return response()->json([
                'error' => true,
            ]);
        }
    }
}
