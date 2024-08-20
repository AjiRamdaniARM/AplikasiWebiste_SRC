<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Participant;
use App\Models\Race;
use App\Models\User;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;

class InvoiceController extends Controller
{
    public function index(Request $request)
    {
        $invoices = Invoice::with('user')->orderBy('created_at', 'desc');
        if ($request->ajax()) {
            return DataTables::eloquent($invoices)
                ->addIndexColumn()
                ->editColumn('status', function (Invoice $invoice) {
                    if ($invoice->status == 'unpaid') {
                        return '<span class="badge badge-danger">'.$invoice->status.'</span>';
                    } elseif ($invoice->status == 'reject') {
                        return '<span class="badge badge-danger">'.$invoice->status.'</span>';
                    } elseif ($invoice->status == 'pending') {
                        return '<span class="badge badge-secondary">'.$invoice->status.'</span>';
                    } elseif ($invoice->status == 'paid') {
                        return '<span class="badge badge-success">'.$invoice->status.'</span>';
                    }

                    return $invoice->status;
                })
                ->addColumn('races', function (Invoice $invoice) {
                    return $invoice->itemRace->map(function ($item) {
                        return '<span class="badge badge-primary">'.$item->name.'</span>';
                    })->implode(' ');
                })
                ->addColumn('sum', function (Invoice $invoice) {

                    if ($invoice->diskon) {
                        $data = $invoice->itemRace()->sum('price') * $invoice->jumlah * ((100 - $invoice->diskon) / 100);
                    } else {
                        $data = $invoice->itemRace()->sum('price') * $invoice->jumlah;
                    }
                    if ($invoice->diskon == null) {
                        return '<span class="badge badge-success">Rp. '.number_format($data, 0, ',', '.').'</span>';
                    } else {
                        return '<span class="badge badge-warning">Rp. '.number_format($data, 0, ',', '.').'( Diskon )'.'</span>';
                    }

                })

                ->editColumn('created_at', function (Invoice $invoice) {
                    return $invoice->created_at_formatted;
                })
                ->addColumn('user', function (Invoice $invoice) {
                    return $invoice->user->name;
                })
                ->addColumn('action', 'dashboard.invoice.action')
                ->rawColumns(['status', 'races', 'sum', 'action'])
                ->toJson();
        }

        return view('dashboard.invoice.index');
    }

    public function create()
    {
        $users = User::select('id', 'name')->get();
        $races = Race::select('id', 'name')->get();

        return view('dashboard.invoice.create', compact('users', 'races'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user' => ['required', 'string'],
            'races' => ['required', 'array', 'min:1'],
        ]);

        $id = IdGenerator::generate(['table' => 'invoices', 'field' => 'name', 'length' => 10, 'prefix' => 'INV-']);

        try {
            DB::beginTransaction();
            $invoice = Invoice::create([
                'user_id' => $request->user,
                'name' => $id,
            ]);

            $invoice->itemRace()->attach($request->races);

            DB::commit();

            alert()->success('Success', 'To make invoice, please paid it !!');

            return redirect()->route('invoice.index');
        } catch (\Throwable $th) {
            DB::rollBack();

            alert()->error('Failed', 'To make invoice, please try again !!');

            return redirect()->route('invoice.index');
        }
    }

    public function show($id)
    {
        $inv = Invoice::findOrFail($id);

        return view('dashboard.invoice.show', compact('inv'));
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => ['required', 'string'],
            'path' => ['nullable', 'string'],
        ]);

        $inv = Invoice::findOrFail($id);

        if (! File::isDirectory('images/payment')) {
            File::makeDirectory('images/payment', 0777, true, true);
        }

        $path = $inv->image;
        if (! is_null($request->path)) {
            $path = 'images/payment/'.trim($request->path, '"');
            $old = public_path().'/tmp/uploads/'.trim($request->path, '"');
            $new = public_path().'/'.$path;
            File::move($old, $new);
            File::delete(public_path().'/'.$inv->image);
        }

        try {
            $inv->update([
                'status' => $request->status,
                'image' => $path,
            ]);

            alert()->success('Success', 'Update invoice');

            return redirect()->route('invoice.index');
        } catch (\Throwable $th) {
            alert()->error('Oops !!', 'Error update invoice');

            return redirect()->route('invoice.index');
        }
    }

    public function destroy($id)
    {
        //
    }

    public function participants($id)
    {
        $user = Auth::user();
        $data = Participant::where('invoice_id', $id)->get();
        // $getInvoice = Invoice::where('id', $id )->get();
        // get data dari 3 table dan gabung
        $getInvoice = DB::table('invoice_races')
            ->join('invoices', 'invoice_races.invoice_id', '=', 'invoices.id')
            ->join('races', 'invoice_races.race_id', '=', 'races.id')
            ->where('invoice_races.invoice_id', $id)
            ->select('invoices.*', 'invoice_races.*', 'races.name as race_name', 'races.id as race_id', 'invoices.id as invoice_id', 'races.max_people', 'invoices.name as invoice_name')
            ->first();

        $hasParticipants = $data->isNotEmpty();

        return view('dashboard.participant.invoice.participants', compact('user', 'data', 'hasParticipants', 'getInvoice'));
    }
}
