<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Race;
use App\Models\User;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Midtrans\Config;

class DetailController extends Controller
{
    public function index($id)
    {
        $user = Auth::user();
        $data = Race::with('category')->find($id);
        if (! $data) {
            abort(404, 'Data not found');
        }

        // Kembalikan tampilan dengan data
        return view('components.user.detail', compact('data', 'user'));
    }

    // public function payment ($id) {
    //     $user = Auth::User();
    //     $data = Race::find($id);
    //     $user = Auth::user();
    //     // data diambil dari awal

    //     // $invoice = DB::table('invoice_races')
    //     //     ->join('Invoices', 'invoice_races.invoice_id', '=', 'Invoices.id')
    //     //     ->where('invoice_races.race_id', $id)
    //     //     ->select('Invoices.*', 'invoice_races.*')
    //     //     ->first();

    //     // data diamabildari yang pertama
    //         $invoice = DB::table('invoice_races')
    //         ->join('invoices', 'invoice_races.invoice_id', '=', 'invoices.id')
    //         ->where('invoice_races.race_id', $id)
    //         ->orderBy('invoices.created_at', 'desc')  // Order by the latest created
    //         ->select('invoices.*', 'invoice_races.*')
    //         ->first();
    //         $nameInvoice = Invoice::where('name', $invoice->name)
    //         ->orderBy('created_at', 'desc')
    //         ->first();

    //     if ($nameInvoice) {
    //         $snapToken = $nameInvoice->snap_token;
    //     } else {
    //         // Handle the case where the invoice is not found
    //         $snapToken = null;
    //     }

    //     if (!$nameInvoice) {
    //         abort(404, 'Invoice not found');
    //     }

    //     $jumlahPrice = $data->price * $invoice->jumlah;

    //     return view('components.user.payment', compact('data','user','invoice', 'snapToken', 'jumlahPrice'));
    // }

    public function payment($id)
    {
        $user = Auth::User();
        $data = Race::find($id);
        $user = Auth::user();
        // data diambil dari awal

        // $invoice = DB::table('invoice_races')
        //     ->join('Invoices', 'invoice_races.invoice_id', '=', 'Invoices.id')
        //     ->where('invoice_races.race_id', $id)
        //     ->select('Invoices.*', 'invoice_races.*')
        //     ->first();

        // data diamabildari yang pertama
        $invoice = DB::table('invoice_races')
            ->join('invoices', 'invoice_races.invoice_id', '=', 'invoices.id')
            ->where('invoice_races.race_id', $id)
            ->orderBy('invoices.created_at', 'desc')  // Order by the latest created
            ->select('invoices.*', 'invoice_races.*')
            ->first();
        $nameInvoice = Invoice::where('name', $invoice->name)
            ->orderBy('created_at', 'desc')
            ->first();

        if ($nameInvoice) {
            $snapToken = $nameInvoice->snap_token;
        } else {
            // Handle the case where the invoice is not found
            $snapToken = null;
        }

        if (! $nameInvoice) {
            abort(404, 'Invoice not found');
        }

        if ($invoice->diskon) {
            $jumlahPrice = ($data->price * $invoice->jumlah) * ((100 - $invoice->diskon) / 100);

            if ($invoice->diskon == 100) {
                $nameInvoice->snap_token = null;
            } else {
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
                        'first_name' => Auth::user()->name,
                        'email' => Auth::user()->email,
                    ],
                ];

                $snapToken = \Midtrans\Snap::getSnapToken($params);

                $nameInvoice->snap_token = $snapToken;

                $nameInvoice->save();

            }

        } else {
            $jumlahPrice = $data->price * $invoice->jumlah;
        }

        return view('components.user.payment', compact('data', 'user', 'invoice', 'snapToken', 'jumlahPrice'));
    }

    public function create(Request $request, $id)
    {
        $data = Race::find($id);
        $idGenerate = IdGenerator::generate(['table' => 'invoices', 'field' => 'name', 'length' => 10, 'prefix' => 'INV-']);
        $invoice = new Invoice;
        $invoice->user_id = $request->user;
        $invoice->name = $idGenerate;
        $invoice->jumlah = $request->jumlah;
        $jumlahPrice = $data->price * $request->jumlah;
        DB::beginTransaction();
        $invoice = Invoice::create([
            'user_id' => $request->user,
            'name' => $idGenerate,
            'jumlah' => $request->jumlah,
        ]);

        $invoice->itemRace()->attach($request->races);
        DB::commit();

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
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email,
            ],
        ];

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        $invoice->snap_token = $snapToken;

        // dd($invoice);
        $invoice->save();

        return redirect('payment/'.$id)->with('success', 'checkout berhasil');
    }

    public function createOnline(Request $request, $id)
    {
        $data = Race::find($id);
        $idGenerate = IdGenerator::generate(['table' => 'invoices', 'field' => 'name', 'length' => 10, 'prefix' => 'INV-']);
        $invoice = new Invoice;
        $invoice->user_id = $request->user;
        $invoice->name = $idGenerate;
        $invoice->jumlah = $request->jumlah;
        $jumlahPrice = $data->price * $request->jumlah;
        DB::beginTransaction();
        $invoice = Invoice::create([
            'user_id' => $request->user,
            'name' => $idGenerate,
            'jumlah' => $request->jumlah,
        ]);

        $invoice->itemRace()->attach($request->races);
        DB::commit();
        $invoice->save();

        return redirect('payment/'.$id)->with('success', 'checkout berhasil');
    }
}
