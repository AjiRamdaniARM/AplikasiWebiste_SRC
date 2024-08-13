<?php

namespace App\Http\Controllers;

use App\Models\ContactMe;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ContactMeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $contacts = ContactMe::with('user');

        if ($request->ajax()) {
            return DataTables::eloquent($contacts)
                ->addIndexColumn()
                ->editColumn('created_at', function (ContactMe $con) {
                    return $con->created_at->format('d-m-Y');
                })
                ->addColumn('user', function (ContactMe $user) {
                    return $user->user->name;
                })
                ->addColumn('action', 'dashboard.contact-me.action')
                ->toJson();
        }

        $title = 'Delete Contact!';
        $text = 'Are you sure you want to delete?';
        confirmDelete($title, $text);

        return view('dashboard.contact-me.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'number' => ['required', 'string', 'min:2'],
            'message' => ['required', 'string', 'min:2'],
        ]);

        try {
            ContactMe::create([
                'user_id' => auth()->id(),
                'number' => $request->number,
                'message' => $request->message,
            ]);

            alert()->success('Success', 'Create contact me');

            return redirect()->route('contact-me.index');
        } catch (\Throwable $th) {
            alert()->error('Oops !!', 'Failed create contact me');

            return redirect()->route('contact-me.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $con = ContactMe::findOrFail($id);

        return response()->json($con);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $con = ContactMe::findOrFail($id);

        $request->validate([
            'numberEdit' => ['required', 'string', 'min:2'],
            'messageEdit' => ['required', 'string', 'min:2'],
        ]);

        try {
            $con->update([
                'user_id' => auth()->id(),
                'number' => $request->numberEdit,
                'message' => $request->messageEdit,
            ]);

            alert()->success('Success', 'Update contact me');

            return redirect()->route('contact-me.index');
        } catch (\Throwable $th) {
            alert()->error('Oops !!', 'Failed update contact me');

            return redirect()->route('contact-me.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $con = ContactMe::findOrFail($id);

        try {
            $con->delete();

            alert()->success('Success', 'Delete contact me');

            return redirect()->route('contact-me.index');
        } catch (\Throwable $th) {
            alert()->error('Oops !!', 'Failed delete contact me');

            return redirect()->route('contact-me.index');
        }
    }
}
