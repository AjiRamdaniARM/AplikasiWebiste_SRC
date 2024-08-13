<?php

namespace App\Http\Controllers;

use App\Models\Organized;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;

class OrganizedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $organizeds = Organized::with('user');

        if ($request->ajax()) {
            return DataTables::eloquent($organizeds)
                ->addIndexColumn()
                ->editColumn('created_at', function (Organized $org) {
                    return $org->created_at->format('d-m-Y');
                })
                ->addColumn('user', function (Organized $user) {
                    return $user->user->name;
                })
                ->editColumn('image', function (Organized $org) {
                    return '<a href="'.asset($org->image).'" target="_blank">See Image...</a>';
                })
                ->addColumn('action', 'dashboard.organized.action')
                ->rawColumns(['image', 'action'])
                ->toJson();
        }

        $title = 'Delete organized!';
        $text = 'Are you sure you want to delete?';
        confirmDelete($title, $text);

        return view('dashboard.organized.index');
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
            'name' => ['required', 'string', 'min:2'],
            'type' => ['required', 'string', 'min:2'],
        ]);

        if (! File::isDirectory('images/organized')) {
            File::makeDirectory('images/organized', 0777, true, true);
        }

        if (! is_null($request->path)) {
            $path = 'images/organized/'.trim($request->path, '"');
            $old = public_path().'/tmp/uploads/'.trim($request->path, '"');
            $new = public_path().'/'.$path;
            File::move($old, $new);
        }

        try {
            Organized::create([
                'user_id' => auth()->id(),
                'name' => $request->name,
                'type' => $request->type,
                'image' => $path,
            ]);

            alert()->success('Success', 'Create organized');

            return redirect()->route('organized.index');
        } catch (\Throwable $th) {
            alert()->error('Oops !!', 'Failed create organized');

            return redirect()->route('organized.index');
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $org = Organized::findOrFail($id);

        $request->validate([
            'nameEdit' => ['required', 'string', 'min:2'],
            'typeEdit' => ['required', 'string', 'min:2'],
        ]);

        if (! File::isDirectory('images/organized')) {
            File::makeDirectory('images/organized', 0777, true, true);
        }

        $path = $org->image;
        if (! is_null($request->path)) {
            $path = 'images/organized/'.trim($request->path, '"');
            $old = public_path().'/tmp/uploads/'.trim($request->path, '"');
            $new = public_path().'/'.$path;
            File::move($old, $new);
            File::delete(public_path().'/'.$org->image);
        }

        try {
            $org->update([
                'user_id' => auth()->id(),
                'name' => $request->nameEdit,
                'type' => $request->typeEdit,
                'image' => $path,
            ]);

            alert()->success('Success', 'Update organized');

            return redirect()->route('organized.index');
        } catch (\Throwable $th) {
            alert()->error('Oops !!', 'Failed update organized');

            return redirect()->route('organized.index');
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
        $loc = Organized::findOrFail($id);

        try {
            $loc->delete();
            File::delete(public_path().'/'.$loc->image);

            alert()->success('Success', 'Delete organized');

            return redirect()->route('organized.index');
        } catch (\Throwable $th) {
            alert()->error('Oops !!', 'Failed delete organized');

            return redirect()->route('organized.index');
        }
    }
}
