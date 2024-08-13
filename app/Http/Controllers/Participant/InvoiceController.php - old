<?php

namespace App\Http\Controllers\Participant;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;

class InvoiceController extends Controller
{
    public function index(Request $request)
    {
        $invoices = Invoice::where('user_id', auth()->id());
    
        if ($request->ajax()) {
            return DataTables::eloquent($invoices)
                ->addIndexColumn()
                ->editColumn('status', function(Invoice $invoice){
                    if ($invoice->status == 'unpaid') {
                        return '<span class="badge badge-danger">'.$invoice->status.'</span>';
                    } elseif ($invoice->status == 'reject') {
                        return '<span class="badge badge-danger">'.$invoice->status.'</span>';
                    }elseif ($invoice->status == 'pending') {
                        return '<span class="badge badge-secondary">'.$invoice->status.'</span>';
                    }elseif ($invoice->status == 'paid') {
                        return '<span class="badge badge-success">'.$invoice->status.'</span>';
                    }
                    
                    return $invoice->status;
                })
                ->addColumn('races', function (Invoice $invoice) {
                    return $invoice->itemRace->map(function($item) {
                        return '<span class="badge badge-primary">'.$item->name.'</span>';
                    })->implode(' ');
                })
                ->addColumn('sum', function (Invoice $invoice) {
                    return '<span class="badge badge-success">Rp. '.number_format($invoice->itemRace()->sum('price'),0,',','.').'</span>';
                })
                ->editColumn('created_at', function(Invoice $invoice){
                    return $invoice->created_at->format('d-m-Y H:i');
                })
                ->addColumn('action', 'dashboard.participant.invoice.action')
                ->rawColumns(['status', 'races', 'sum', 'action'])
                ->toJson();
        }
        return view('dashboard.participant.invoice.index');
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
            if(!File::isDirectory('images/payment')){
                File::makeDirectory('images/payment', 0777, true, true);
            }
            
            if (!is_null($request->path)) {
                $path = 'images/payment/'.trim($request->path, '"');
                $old = public_path().'/tmp/uploads/'.trim($request->path, '"');
                $new = public_path().'/'.$path;
                File::move($old, $new);
            }

            $inv->update([
                'status' => 'pending',
                'image' => $path
            ]);

            alert()->success('Success', 'Payment will be process');
            return redirect()->route('participant.invoice.index');
        } catch (\Throwable $th) {
            alert()->error('Oops !!', 'Payment error');
            return redirect()->route('participant.invoice.index');
        }
    }
}
