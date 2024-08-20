<?php

namespace App\Http\Controllers\Participant;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;

class InvoiceController extends Controller
{
    public function index(Request $request)
    {
        $invoices = Invoice::where('invoices.user_id', auth()->id())
            ->join('invoice_races', 'invoices.id', '=', 'invoice_races.invoice_id')
            ->join('races', 'invoice_races.race_id', '=', 'races.id')
            ->join('categories', 'races.category_id', '=', 'categories.id')
            ->select(
                'invoices.*',
                'races.*',
                'invoice_races.*',
                'races.name as race_name',
                'invoices.name as invoices_name',
                'races.id as races_id',
                'invoices.id as invoice_id',
                'categories.name as category_name',

            )
            ->orderBy('invoices.created_at', 'desc')
            ->get();

        $user = Auth::user();

        if ($request->ajax()) {
            return DataTables::eloquent($invoices)
                ->addIndexColumn()
                ->editColumn('status', function (Invoice $invoice) {
                    if ($invoice->status == 'unpaid') {
                        return '<span class="badge badge-danger">Belum Bayar</span>';
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
                    $data = $invoice->itemRace()->sum('price') * $invoice->jumlah;

                    return '<span class="badge badge-success">Rp. '.number_format($data, 0, ',', '.').'</span>';
                })
                ->editColumn('created_at', function (Invoice $invoice) {
                    return $invoice->created_at->format('F j, Y, g:i a');
                })
                ->addColumn('action', function (Invoice $invoice) {
                    return view('dashboard.participant.invoice.action', compact('invoice'))->render();
                })
                ->rawColumns(['status', 'races', 'sum', 'action'])
                ->toJson();
        }

        return view('dashboard.participant.invoice.index', compact('invoices', 'user'));
    }

    public function show($id)
    {
        $inv = Invoice::where([
            ['name', '=', $id],
            ['user_id', '=', auth()->id()],
        ])->firstOrFail();

        return view('dashboard.participant.invoice.show', compact('inv'));
    }

    public function store(Request $request, $id)
    {
        $inv = Invoice::where([
            ['name', '=', $id],
            ['user_id', '=', auth()->id()],
        ])->firstOrFail();

        try {
            if (! File::isDirectory('images/payment')) {
                File::makeDirectory('images/payment', 0777, true, true);
            }

            if (! is_null($request->path)) {
                $path = 'images/payment/'.trim($request->path, '"');
                $old = public_path().'/tmp/uploads/'.trim($request->path, '"');
                $new = public_path().'/'.$path;
                File::move($old, $new);
            }

            $inv->update([
                'status' => 'pending',
                'image' => $path,
            ]);

            alert()->success('Success', 'Payment will be process');

            return redirect()->route('participant.invoice.index');
        } catch (\Throwable $th) {
            alert()->error('Oops !!', 'Payment error');

            return redirect()->route('participant.invoice.index');
        }
    }
}
