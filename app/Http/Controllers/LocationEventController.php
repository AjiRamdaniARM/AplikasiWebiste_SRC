<?php

namespace App\Http\Controllers;

use App\Models\LocationEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class LocationEventController extends Controller
{
    public function index(Request $request)
    {
        $locations = LocationEvent::with('user');

        if ($request->ajax()) {
            return DataTables::eloquent($locations)
                ->addIndexColumn()
                ->editColumn('created_at', function (LocationEvent $loc) {
                    return $loc->created_at->format('d-m-Y');
                })
                ->addColumn('user', function (LocationEvent $user) {
                    return $user->user->name;
                })
                ->editColumn('link_address', function (LocationEvent $loc) {
                    return Str::limit($loc->link_address, 30, '...');
                })
                ->addColumn('action', 'dashboard.location-event.action')
                ->toJson();
        }

        $title = 'Delete Location Event!';
        $text = 'Are you sure you want to delete?';
        confirmDelete($title, $text);

        return view('dashboard.location-event.index');
    }

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
            'name' => ['required', 'string', 'min:2'],
            'address' => ['required', 'string', 'min:2'],
            'link_address' => ['required', 'string', 'min:2'],
        ]);

        try {
            LocationEvent::create([
                'user_id' => auth()->id(),
                'name' => $request->name,
                'address' => $request->address,
                'link_address' => $request->address,
            ]);

            alert()->success('Success', 'Create location event');

            return redirect()->route('location-event.index');
        } catch (\Throwable $th) {
            alert()->error('Oops !!', 'Failed create location event');

            return redirect()->route('location-event.index');
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
    public function edit($id) {}

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $loc = LocationEvent::findOrFail($id);

        $request->validate([
            'nameEdit' => ['required', 'string', 'min:2'],
            'addressEdit' => ['required', 'string', 'min:2'],
            'linkAddressEdit' => ['required', 'string', 'min:2'],
        ]);

        try {
            $loc->update([
                'user_id' => auth()->id(),
                'name' => $request->nameEdit,
                'address' => $request->addressEdit,
                'link_address' => $request->linkAddressEdit,
            ]);

            alert()->success('Success', 'Update location event');

            return redirect()->route('location-event.index');
        } catch (\Throwable $th) {
            alert()->error('Oops !!', 'Failed update location event');

            return redirect()->route('location-event.index');
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
        $loc = LocationEvent::findOrFail($id);

        try {
            $loc->delete();

            alert()->success('Success', 'Delete location event');

            return redirect()->route('location-event.index');
        } catch (\Throwable $th) {
            alert()->error('Oops !!', 'Failed delete location event');

            return redirect()->route('location-event.index');
        }
    }
}
